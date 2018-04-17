<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Project extends Model
{
    use Sortable;

    protected $table = 'projects';

    protected $primaryKey = 'id';
    
	public $timestamps = false;

	public function process()
    {
        return $this->belongsTo('App\Process', 'process_id', 'recordid');
    }

    public function agency()
    {
        return $this->hasmany('App\Agency', 'recordid', 'agency_code', 'agencycode');
    }

    public function district()
    {
        return $this->belongsTo('App\District', 'district_ward_name', 'recordid');
    }
}
