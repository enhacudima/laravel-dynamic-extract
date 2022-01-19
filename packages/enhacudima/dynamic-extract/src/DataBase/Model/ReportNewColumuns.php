<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportNewColumuns extends Model
{
    protected $table = 'report_new_columuns';
    protected $guarded =array();

    public $primaryKey = 'id';

    public $timestamps=true;
    
        public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

        public function filtro()
    {
        return $this->belongsTo('App\ReportNewFiltro','report_new_filtro_id','id');
    }
    
    
}
