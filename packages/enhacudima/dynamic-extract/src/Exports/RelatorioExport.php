<?php

namespace Enhacudima\DynamicExtract\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Enhacudima\DynamicExtract\DataBase\Model\ProcessedFiles;
use Enhacudima\DynamicExtract\DataBase\Model\ReportNew;
use DB;
use Enhacudima\DynamicExtract\Http\Controllers\ExportQueryController;

class RelatorioExport implements FromQuery, ShouldAutoSize, WithHeadings
{

    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($start,$end,$type,$filtro,$request)
    {
        $q = new ExportQueryController($start,$end,$type,$filtro,$request);

        $this->eq=$q->query();
    }
    public function headings(): array
    {
        return $this->eq['heading'];
    }

    public function query()
    {

        return $this->eq['data'];

    }


}
