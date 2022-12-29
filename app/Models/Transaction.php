<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory;
    use softDeletes;
    
    public $timestamps = true;
    protected $fillable = [
        'c_id',
        'total_amount',
        'status',
    ];

    public function customer()
    {
         return $this->hasOne(User::class,'id','c_id');
    }
    public function orderlines()
    {
         return $this->hasMany(Orderline::class,'t_id');
    }
    // public function one_pet()
    // {
    //      return $this->hasOne(Pet::class,'p_id','p_id');
    // }
    // public function employee()
    // {
    //      return $this->hasOne(User::class,'id','e_id');
    // }
}
