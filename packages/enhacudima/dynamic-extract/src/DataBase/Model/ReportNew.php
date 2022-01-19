<?php

namespace Enhacudima\DynamicExtract\DataBase\Model;

use Illuminate\Database\Eloquent\Model;
use App\ReportNewFiltro;

class ReportNew extends Model
{
    protected $table = 'report_new';
    protected $guarded =array();

    public $primaryKey = 'id';

    public $timestamps=true;



        public function sync_filtros()
    {
        return $this->hasMany('App\ReportNewSyncFiltro','groupo_filtro','filtro');
    }

        public function table()
    {
        return $this->belongsTo('App\ReportNewTables','table_name','id');
    }

        public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

        public function filtro_r()
    {
        return $this->belongsTo('App\ReportNewFiltroGroupo','filtro','id');
    }

}
