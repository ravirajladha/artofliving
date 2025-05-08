<?php

namespace App\Imports;

use App\Models\Test;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Test([
            'a' => $row[0],
            'b' => $row[1], 
            'c' => $row[2] ,
            'd' => $row[3],
            'e' => $row[4], 
            'f' => $row[5],
            'g' => $row[6],
        ]);
    }
}
