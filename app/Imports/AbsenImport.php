<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Carbon\Carbon;

class AbsenImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $name1 = $collection[2][9];
        $name2 = $collection[2][24];
        $name3 = $collection[2][39];
        $periode = $collection[1][3];
        if(!empty($name2)){
            $data = $collection->slice('11','33');
            $time = [];
            foreach($data as $index => $item){
                $day = str_pad(substr($item[0], 0, 2), 2, '0', STR_PAD_LEFT);
                // $parsedDate = Carbon::createFromFormat('d', $day);
                // $year = Carbon::now()->year;
                // $formattedDate = $parsedDate->format('d');
                // $date = $year.'-'.$formattedDate;
                $time[] = [
                   
                    'index'=>$index,
                    'in'=>$item[6],
                    'out'=>$item[8],
                    'date'=>$formattedDate
                ];
            }
        }
        dd($time);
        
    }
}
