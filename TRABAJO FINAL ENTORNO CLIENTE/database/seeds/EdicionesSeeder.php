<?php

use App\Edicion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EdicionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Company::create([
            'nombre_edicion' => ' theros',
            'anyo' => '2020',
            'modalidad' => 'standar',
            'tipo' => 'a2',
            
        ]);

        Company::create([
            'nombre_edicion' => ' travesia hacia nyx',
            'anyo' => '2016',
            'modalidad' => ' common',
            'tipo' => 'c2',
        ]);

                                      

    }
}