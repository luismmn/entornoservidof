<?php

use App\Carta;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Carta::create([
            'nombre_carta' => 'rayo doble',
            'color' => 'rojo',
            'tipo' => 'conjuro',
            'precio' => ' 3e',
            
        ]);

        Carta::create([
            'nombre_carta' => 'aplastatierra',
            'color' => 'verde',
            'tipo' => 'criatura',
            'precio' => '1e',
            
        ]);

        

    }
}
