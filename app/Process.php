<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    protected $table = 'process';
    
	public $timestamps = false;

	public function project()
    {
        return $this->hasMany('App\Project', 'process_id', 'recordid');
    }
}
