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
        $plants = Plants::with('details')->where(function($query) {
            $query->whereRelation('details', 'active_growth_period', '!=', '');
        })->get();

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
