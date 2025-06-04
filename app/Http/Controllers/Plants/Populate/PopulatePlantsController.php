<?php

namespace App\Http\Controllers\Plants\Populate;

use App\Models\Plants\Plant_Details;
use App\Models\Plants\Plants;
use GuzzleHttp;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;

class PopulatePlantsController extends \App\Http\Controllers\Controller
{
    /**
     * @throws GuzzleException
     */
    public function populate()
    {
        $client = new GuzzleHttp\Client();
        $offset = -1;
        $plants = [];

        $loopCount = ceil($this->getCharacteristicSearchResponse($client, $offset)->get('TotalResults') / 25);
        $offset  = 0;

        for ($i = 1; $i < $loopCount; $i++)
        {
            $loopRes = collect($this->getCharacteristicSearchResponse($client, $offset)['PlantResults'])->map(function ($data) {
                $data->characteristics = [];
                return $data;
            });

            for($x = 1; $x < count($loopRes); $x++)
            {
                $id = $loopRes[$x]->Id;

                $resProf = $client->get('https://plantsservices.sc.egov.usda.gov/api/PlantCharacteristics/'.$id, [
                    'headers' => [
                        'Content-Type'  => 'application/json',
                        'Accept'        => 'application/json',
                    ]
                ]);

                $characteristicsRaw = json_decode($resProf->getBody()->getContents());

                $characteristicsCollect = collect($characteristicsRaw)->groupBy(function($data) {
                    return $data->PlantCharacteristicName;
                })->map(function ($data) {
                    return $data->first()->PlantCharacteristicValue;
                });

                $loopRes[$x]->characteristics = $characteristicsCollect->all();
            }

            $plants = array_merge($plants,$loopRes->all());

            $offset++;
        }
        dd(json_encode(collect($plants)));
    }

    /**
     * @param Client $client
     * @param int $offset
     * @return Collection
     * @throws GuzzleException
     */
    public function getCharacteristicSearchResponse(GuzzleHttp\Client $client, int $offset)
    {
        $res = $client->post('https://plantsservices.sc.egov.usda.gov/api/CharacteristicsSearch', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'body' => json_encode([
                'Text' => NULL,
                'Field' => NULL,
                'Locations' => NULL,
                'Groups' => NULL,
                'Durations' => NULL,
                'GrowthHabits' => NULL,
                'WetlandRegions' => NULL,
                'NoxiousLocations' => NULL,
                'InvasiveLocations' => NULL,
                'Countries' => NULL,
                'Provinces' => NULL,
                'Counties' => NULL,
                'Cities' => NULL,
                'Localities' => NULL,
                'ArtistFirstLetters' => NULL,
                'ImageLocations' => NULL,
                'Artists' => NULL,
                'CopyrightStatuses' => NULL,
                'ImageTypes' => NULL,
                'SortBy' => 'sortSciName',
                'Offset' => $offset == -1 || $offset == 0 ? $offset : $offset * 25,
                'FilterOptions' => NULL,
                'UnfilteredPlantIds' => NULL,
                'Type' => 'Characteristics',
                'TaxonSearchCriteria' => NULL,
                'MasterId' => -1
            ])
        ]);

        return collect(json_decode($res->getBody()->getContents()));
    }

    /**
     * @return void
     */
    public function processJson() {
        $file = file_get_contents('E:/Websites/growopwiki/usda-plants.json');

        $plantsCollection = collect(json_decode($file, true))->map(function($plantArr) {
            $plant = new Plants();

            $plant->symbol = $plantArr['Symbol'] ?? '';
            $plant->scientific_name = $plantArr['ScientificName'] ?? null;
            $plant->common_name = $plantArr['CommonName'] ?? null;
            $plant->duration = $plantArr['Durations'] ?? '';
            $plant->growth_habit = $plantArr['GrowthHabits'] ?? '';

            return $plant;
        });

        Plants::insert($plantsCollection->toArray());

        $plantDetailsCollection = collect(json_decode($file, true))->map(function($plantDetailsArr, $index) {
            $plantCharacteristics = $plantDetailsArr['characteristics'];

            $plantDetails = new Plant_Details();

            $plantDetails->plant_id = $index + 1;
            $plantDetails->active_growth_period = $plantCharacteristics['Active Growth Period'] ?? null;
            $plantDetails->growth_rate = $plantCharacteristics['Growth Rate'] ?? '';
            $plantDetails->drought_tolerance = $plantCharacteristics['Drought Tolerance'] ?? '';
            $plantDetails->fertility_requirement = $plantCharacteristics['Fertility Requirement'] ?? '';
            $plantDetails->adapted_coarse_soil = $plantCharacteristics['Adapted to Coarse Textured Soils'] == "Yes" ?? -1;
            $plantDetails->adapted_fine_soil = $plantCharacteristics['Adapted to Fine Textured Soils'] == "Yes" ?? -1;
            $plantDetails->adapted_medium_soil = $plantCharacteristics['Adapted to Medium Textured Soils'] == "Yes" ?? -1;
            $plantDetails->ph_min = $plantCharacteristics['pH, Minimum'] ?? 0;
            $plantDetails->ph_max = $plantCharacteristics['pH, Maximum'] ?? 0;
            $plantDetails->temp_min = $plantCharacteristics['Temperature, Minimum (°F)'] ?? 0;
            $plantDetails->mature_height = $plantCharacteristics['Height, Mature (feet)'] ?? 0;
            $plantDetails->root_depth = $plantCharacteristics['Root Depth, Minimum (inches)'] ?? 0;

            return $plantDetails;
        });

        Plant_Details::insert($plantDetailsCollection->toArray());
    }

    /**
     * @return void
     */
    public function getDataFromUSDA() {
//        $file = file_get_contents('D:/Desktop/usdaplants.json');
//
//        $plantsCollection = collect(json_decode($file, true))->map(function($a) {
//            dd($a);
//        });
    }

    /**
     * @return string
     */
    public function exportToCSV() {
        $plantsCollection = Plants::with('details')->get();

        $plantsMergedDetails = $plantsCollection->map(function($q) {
           return [
              $q->symbol,
              $q->scientific_name,
              $q->common_name,
              $q->duration,
              $q->growth_habit,
              $q->subkingdom,
              $q->superdivision,
              $q->division,
              $q->details->active_growth_period,
              $q->details->growth_rate,
              $q->details->drought_tolerance,
              $q->details->fertility_requirement,
              $q->details->adapted_coarse_soil,
              $q->details->adapted_fine_soil,
              $q->details->adapted_medium_soil,
              $q->details->ph_min,
              $q->details->ph_max,
              $q->details->temp_min,
              $q->details->mature_height,
              $q->details->root_depth
           ];
        });

        dd($plantsMergedDetails->first());
    }
}
