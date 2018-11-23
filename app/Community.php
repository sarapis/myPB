<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Community extends Model
{
    use Sortable;

    protected $table = 'communities';

    protected $primaryKey = 'id';
    
	public $timestamps = false;


    public function district()
    {
        return $this->belongsTo('App\District', 'district_ward', 'recordid');
    }
}
