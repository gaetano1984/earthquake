<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class earthQuake extends Model
{
    //
    protected $table = 'earthquake';

    public $timestamps = FALSE;

    public function scopeRecent(){
    	return \DB::table('earthquake')->limit(10)->orderBy('creationTime', 'desc')->get()->toArray();
    }

    public function notified($idevents){
    	$data['notified']=1;
		\DB::table('earthquake')->whereIn('id_earthquake', $idevents)->update($data);
    }
}
