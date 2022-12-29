<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
class Game extends Model implements Searchable
{
    use HasFactory;
    use softDeletes;

    public $timestamps = true;
    protected $fillable = [
        'title',
        'price',
        'description',
        'genre_id',
        'img',
        'platform',
        'stocks',
    ];

    public function getSearchResult(): SearchResult
     {

        
        $d = json_decode($this);
         return new \Spatie\Searchable\SearchResult(
                $this,
                $d->title
        );
     }

    public function transaction()
    {
         return $this->belongsToMany(Transaction::class,'g_id');
    }
    public function genre()
    {
         return $this->belongsTo(Genre::class,'genre_id');
    }
    public function comments()
    {
         return $this->hasMany(Game_Comment::class,'g_id');
    }

}
