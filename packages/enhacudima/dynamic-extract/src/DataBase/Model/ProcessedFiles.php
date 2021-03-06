<?php

namespace Enhacudima\DynamicExtract\DataBase\Model;

use Illuminate\Database\Eloquent\Model;

class ProcessedFiles extends Model
{
    protected $table = 'processed_files';
    protected $guarded =array();
    protected $casts = ['filterData' => 'array'];
    public $primaryKey = 'id';

    public $timestamps=true;


    public function user()
    {
        return $this->belongsTo(config('dynamic-extract.middleware.model'),'user_id','id');
    }
}
