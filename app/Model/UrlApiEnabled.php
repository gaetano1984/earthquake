<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UrlApiEnabled extends Model
{
    //
    protected $table = "url_api_enabled";

    public $timestamps = false;

    public function paginate($limit=10){
    	$apis = \DB::table($this->table)->paginate($limit);
    	return $apis;
    }
}
