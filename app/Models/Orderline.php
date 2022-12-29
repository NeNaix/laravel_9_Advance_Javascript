<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Orderline extends Model
{
    use HasFactory,softDeletes;
    
    public $timestamps = true;
    protected $fillable = [
        't_id',
        'g_id',
        'qty',
        'total',
    ];

    public function game()
    {
         return $this->hasOne(Game::class,'id','g_id');
    }

}
