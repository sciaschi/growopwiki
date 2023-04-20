<?php

namespace App\Models\Plants\Attributes;

use App\Models\Plants\Plants;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait PlantDetailsRelationships {

    /**
     * Get the user associated with the Relationship
     *
     * @return HasOne
     */
    public function plant(): HasOne
    {
        return $this->hasOne(Plants::class, 'id', 'plant_id');
    }

}
