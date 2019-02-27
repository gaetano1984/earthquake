<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EarthQuake extends Model
{
    //
    protected $table = 'earthquake';

    public $timestamps = FALSE;

    public function paginateRecent($limit=10){
        return \DB::table('earthquake')->join('location', 'location_id', '=', 'location.id')->orderBy('creationTime', 'desc')->paginate($limit);
    }

    public function scopeRecent(){
    	return \DB::table('earthquake')->limit(10)->orderBy('creationTime', 'desc')->get()->toArray();
    }

    public function notified($idevents){
    	$data['notified']=1;
		\DB::table('earthquake')->whereIn('id_earthquake', $idevents)->update($data);
    }

    public function location(){
        return $this->hasOne('\App\Model\Location', 'id', 'location_id');
    }
}
