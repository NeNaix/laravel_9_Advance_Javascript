<?php

namespace App\Imports;

use App\Models\Pet;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PetImporter implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $check = User::where('fname',$row["customer_first_name_or_lastname"])->orWhere('lname',$row["customer_first_name_or_lastname"])->get();
        if (count($check) > 0) {
             return new Pet([
            'c_id' => $check[0]->id ,
            'pname' => $row['pet_name'],
            'ptype' => $row['type'],
            'page' => (int) $row['age'],
            'pimg' => 'storage/images/tao.png',
        ]);
        }
       
    }
}
