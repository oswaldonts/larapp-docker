<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class DamageType extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'damage_types';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
