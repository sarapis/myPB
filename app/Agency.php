<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    protected $table = 'agency';
    
	public $timestamps = false;

	public function project()
    {
        return $this->hasMany('App\Project', 'agency_code', 'recordid');
    }
}
