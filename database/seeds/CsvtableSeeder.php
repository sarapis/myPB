<?php

use Illuminate\Database\Seeder;

class CsvtableGenerate extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('csv')->delete();
        
	    DB::table('csv')->insert([
		    [		
	    		'id'=>'1',
	    		'name' 		=> 'Source: ',
	    		'description' 		=> ''
		    ],
		    [		
	    		'id'=>'2',
	    		'name' 			=> 'Filtered by: ',
	    		'description' 		=> ''
		    ],
		    [		
	    		'id'=>'3',
	    		'name' 			=> 'Downloaded: ',
	    		'description' 		=> ''
		    ]
		]);
    }
}
