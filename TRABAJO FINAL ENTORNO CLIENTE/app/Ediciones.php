<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ediciones extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre_edicion', 'anyo', 'modalidad','tipo',
    ];
}