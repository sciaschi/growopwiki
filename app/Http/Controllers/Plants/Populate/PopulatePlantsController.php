<?php

namespace App\Http\Controllers\Plants\Populate;

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
                'Offset' => $offset,
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
//        $file = file_get_contents('D:/Desktop/usdaplants.json');
//
//        $plantsCollection = collect(json_decode($file, true))->map(function($a) {
//            dd($a);
//        });

    }
}
