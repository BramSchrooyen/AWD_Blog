<?php
/**
 * Created by PhpStorm.
 * User: Bram Schrooyen
 * Date: 1/12/2017
 * Time: 12:20
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like
{

    public function blog(){
        return $this->belongsTo('App\Blog');
    }

    public function user(){
        return $this->belognsTo('App\Blog');
    }

}