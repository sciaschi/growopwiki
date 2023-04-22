<?php

namespace App\Models\Plants\Attributes;

use App\Models\Plants\Plants;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait PlantDetailsRelationships {

    /**
     * Get the user associated with the Relationship
     *
     * @return BelongsTo
     */
    public function plant(): belongsTo
    {
        return $this->belongsTo(Plants::class, 'id', 'plant_id');
    }

}
