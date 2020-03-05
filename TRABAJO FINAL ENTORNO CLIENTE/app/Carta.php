<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cartas extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre_carta', 'precio', 'color','tipo',
    ];
}