<?php

use Illuminate\Database\Seeder;

class LayoutGenerate extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('layout')->delete();
         DB::table('layout')->insert([
			    [		'id' 			=> '1',
			    		'logo' 		=> 'mypb.png',
			    		'site_name' 		=> 'myPB',
			    		'tagline' 	=> '',
			    		'contact_text' 			=> 'Love it? Change it? We\'d love to hear your thoughts!',
			    		'contact_btn_label' 		=> 'Feedback',
			    		'contact_btn_link' 		=> '/feedback',
			    		'footer'  => ''
			    		
			    ]

			]); 
    }
}
