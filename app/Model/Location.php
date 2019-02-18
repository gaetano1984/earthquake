<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    //
    protected $table = 'location';

	public $timestamps = FALSE;

	protected $fillable = ['name'];
}
