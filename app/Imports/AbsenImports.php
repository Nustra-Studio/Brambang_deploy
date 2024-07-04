<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Imports\AbsenImport;

class AbsenImports implements WithMultipleSheets
{
    /**
    * @param Collection $collection
    */
    public function sheets(): array
    {
        return [
            "1.2.3"=> new AbsenImport(),
            "4.5.6"=> new AbsenImport(),
            "7.8.9"=> new AbsenImport(),
            "10.11.12"=> new AbsenImport(),
            "13.14.15"=> new AbsenImport(),
            "16.17.18"=> new AbsenImport(),
            "19.20.21"=> new AbsenImport(),
            "22.23"=> new AbsenImport(),
        ];
    }
}
