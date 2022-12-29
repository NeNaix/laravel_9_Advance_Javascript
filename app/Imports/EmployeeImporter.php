<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EmployeeImporter implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'fname' => $row[0],
            'lname' => $row[1],
            'addr' => $row[2],
            'img' => 'storage/images/av.png',
            'role' => 'employee',
            'email' => $row[3],
            'password' => Hash::make($row[4]),
        ]);
    }
}
