<?php

namespace App\Models\Plants\Attributes;

use App\Models\Plants\Plant_Details;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait PlantsRelationships {

    /**
     * Get the user associated with the Relationship
     *
     * @return HasOne
     */
    public function details(): HasOne
    {
        return $this->hasOne(Plant_Details::class, 'plant_id', 'id');
    }

}
