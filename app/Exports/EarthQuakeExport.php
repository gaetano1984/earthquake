<?php

namespace App\Exports;


use App\Model\EarthQuake;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class EarthQuakeExport implements FromView, ShouldAutoSize
{

	use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public $mag_min=7;
    public $mag_max=8;
    public function __construct($filters){
    	if(array_key_exists('magnitudo_minima', $filters)){
    		$this->mag_min = $filters['magnitudo_minima'];
    	}
    	if(array_key_exists('magnitudo_massima', $filters)){
    		$this->mag_max = $filters['magnitudo_massima'];
    	}
    	if(array_key_exists('min_date', $filters)){
    		$this->min_date = $filters['min_date'];
		}
		if(array_key_exists('max_date', $filters)){
    		$this->max_date = $filters['max_date'];
		}
		if(array_key_exists('location', $filters)){
    		$this->location = $filters['location'];
		}
    }

    public function model(array $row){
        return new EarthQuake([
            'id' => $row['id']
            ,'date' => $row['creationTime']
        ]);
    }

    public function query()
    {
    	$query = EarthQuake::query();
    	$query = $query->join('location', 'location_id', '=', 'location.id');
        $query = $query->whereBetween('magnitude', [$this->mag_min, $this->mag_max])
            ->whereBetween('creationTime', [$this->min_date, $this->max_date]);
        if(isset($this->location_id) && $this->location!="-1"){    
            $query = $query->where('location_id', $this->location);
        }
        $query = $query->select(['earthquake.id', 'creationTime', 'name', 'magnitude', 'latitude', 'longitude'])
        ->orderBy('creationTime', 'asc')
        ->get();
        return $query;
    }

    public function view(): View{
        return view('earthquake.exports.stats_export', [
            'earthquake' => $this->query()
        ]);
    }
}
