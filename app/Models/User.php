<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

use Tymon\JWTAuth\Contracts\JWTSubject;
// use Spatie\Searchable\Searchable;
// use Spatie\Searchable\SearchResult;

class User extends Authenticatable implements MustVerifyEmail
// implements Searchable
{ 
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];
    protected $fillable = [
        'lname',
        'fname',
        'email',
        'address',
        'img',
        'role',
        'deleted_at',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function getSearchResult(): SearchResult
    //  {
    //     $d = json_decode($this);
    //     $url = route('customer.show',$d->id);

    //     // dd(new \Spatie\Searchable\SearchResult(
    //     //         $this,
    //     //         "Search Result",
    //     //         $url
    //     // ));
    //      return new \Spatie\Searchable\SearchResult(
    //             $this,
    //             $d->fname." ".$d->lname ,
    //             $url
    //     );
    //  }

    // public function pet()
    // {
    //      return $this->hasMany(Pet::class,'c_id','id');
    // }
    // public function one_pet()
    // {
    //      return $this->hasOne(Pet::class,'c_id');
    // }

    // public function transactions()
    // {
    //      return $this->hasMany(Transaction::class,'c_id','id');
    // }

}
