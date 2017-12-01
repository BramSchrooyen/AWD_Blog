<?php
/**
 * Created by PhpStorm.
 * User: Bram Schrooyen
 * Date: 1/12/2017
 * Time: 13:35
 */

namespace App;


class Comment extends Model
{

    protected $fillable = ['title','content'];

    public function blog(){
        return $this->belongsTo('App\Blog');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

}