<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Game_Comment extends Model
{
    use HasFactory;
    use softDeletes;

    protected $table = 'games_comments';

    public $timestamps = true;
    protected $fillable = [
        'g_id',
        'c_id',
    ];

    // public function transaction()
    // {
    //      return $this->belongsTo(Transaction::class,'t_id');
    // }
    // public function service()
    // {
    //      return $this->belongsTo(Service::class,'s_id');
    // }
}
