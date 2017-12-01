<?php
/**
 * Created by PhpStorm.
 * User: Bram Schrooyen
 * Date: 1/12/2017
 * Time: 12:19
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    protected $fillable = ['name'];

    public function blogs(){
        return $this->belongsToMany('App\Blog');
    }

}