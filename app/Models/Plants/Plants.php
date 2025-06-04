<?php

namespace App\Models\Plants;

use App\Models\Plants\Attributes\PlantsRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Plants extends Model
{
    use Searchable, HasFactory, PlantsRelationships;

    /**
     * Table Name
     * @var string
     */
    protected $table = 'plants';

    /**
     * Has Timestamps
     *
     * @var bool
     */
    public  $timestamps = true;

    /**
     * Fillable Columns
     *
     * @var bool
     */
    protected $fillable = [
        'symbol',
        'scientific_name',
        'common_name',
        'duration',
        'growth_habit',
        'subkingdom',
        'superdivision',
        'division'
    ];
}
