<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class AmmunitionType extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ammunition_types';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
