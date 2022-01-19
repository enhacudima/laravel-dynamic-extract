<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportNewFiltroGroupo extends Model
{
    protected $table = 'report_new_filtro_group';
    protected $guarded =array();

    public $primaryKey = 'id';

    public $timestamps=true;


    public function sync_filtros()
    {
        return $this->hasMany('App\ReportNewSyncFiltro','groupo_filtro','id');
    } 
    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

}
