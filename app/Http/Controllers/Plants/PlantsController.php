<?php

namespace App\Http\Controllers\Plants;

use App\Http\Controllers\Controller;
use App\Models\Plants\Plant_Details;
use App\Models\Plants\Plants;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PlantsController extends Controller
{
    /**
     * All Plants Page
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $plantsCollection = Plants::with('details')->where('common_name', '!=', null)->get();

        $plants = $plantsCollection->map(function($plant) {
            $plant->common_name = ucwords($plant->common_name);
            $plant->scientific_name = strip_tags(html_entity_decode($plant->scientific_name));

            return $plant;
        })->sortBy('common_name')->values();

        return view('plants/index')->with([
            'plants' => $plants
        ]);
    }

    /**
     * Plant Details Page
     *
     * @param $slug string
     * @return Application|Factory|View
     */
    public function details(string $slug): View|Factory|Application
    {
        $plant = Plants::with('details')->whereRaw('slug = ?', $slug)->get()->first();

        return view('plants/details')->with([
            'plant' => $plant,
            'details' => $plant->details()->get()->first()
        ]);
    }
}
