<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Process extends Model
{
	use Sortable;

    protected $table = 'process';
    
	public $timestamps = false;

	public function project()
    {
        return $this->hasMany('App\Project', 'process_id', 'recordid');
    }
}
