<?php

use Illuminate\Database\Seeder;

class PrestacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('prestacion')->insert([
	        	'nombre' => 'Psicomotricidad'
	        ],
	    	[
	        	'nombre' => 'Psicologia'
	        ],
	        [
	        	'nombre' => 'Maestra de Apoyo'
	        ]
    	);
    }
}
