<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class TierType extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tier_types';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
