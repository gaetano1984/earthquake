<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EarthQuake extends Model
{
    //
    protected $table = 'earthquake';

    public $timestamps = FALSE;

    public function paginateRecent($limit=10){
        return \DB::table('earthquake')->paginate($limit);
    }

    public function scopeRecent(){
    	return \DB::table('earthquake')->limit(10)->orderBy('creationTime', 'desc')->get()->toArray();
    }

    public function notified($idevents){
    	$data['notified']=1;
		\DB::table('earthquake')->whereIn('id_earthquake', $idevents)->update($data);
    }

    public function distLocation(){
        $arr = [];
        $e = EarthQuake::distinct('location')->get()->toArray();
        foreach($e as $event){
            $location = preg_replace('/^[0-9]{1,} km [A-Z]{1,3} /', '', $event['location']);
            $arr[$location]=1;
        }
        $arr = array_keys($arr);
        return $arr;
    }
}
