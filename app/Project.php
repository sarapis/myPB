<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';
    
	public $timestamps = false;

	public function process()
    {
        return $this->belongsTo('App\Process', 'process_id', 'recordid');
    }

    public function agency()
    {
        return $this->hasmany('App\Agency', 'recordid', 'agency_code');
    }

    public function district()
    {
        return $this->belongsTo('App\District', 'district_ward_name', 'recordid');
    }
}
