<?php

namespace App\Models\Plants;

use App\Models\Plants\Attributes\PlantDetailsRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plant_Details extends Model
{
    use HasFactory, PlantDetailsRelationships;

    /**
     * Table Name
     * @var string
     */
    protected $table = 'plant_details';

    /**
     * Has Timestamps
     *
     * @var bool
     */
    public  $timestamps = false;

    /**
     * Fillable Columns
     *
     * @var bool
     */
    protected $fillable = [
        'plant_id',
        'active_growth_period',
        'growth_rate',
        'drought_tolerance',
        'fertility_requirement',
        'adapted_coarse_soil',
        'adapted_fine_soil',
        'adapted_medium_soil',
        'ph_min',
        'ph_max',
        'temp_min',
        'mature_height',
        'root_depth'
    ];
}
