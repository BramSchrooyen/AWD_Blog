<?php
/**
 * Created by PhpStorm.
 * User: Bram Schrooyen
 * Date: 01/12/17
 * Time: 12:17
 */

namespace App;


use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{

    protected $fillable = ['title', 'content', 'lat', 'long'];

    public function likes(){
        return $this->hasMany('App\Like');
    }

    public function tags(){
        return $this->belongsToMany('App\Tag');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function user(){
        return $this-> belongsTo('App\User');
    }

}