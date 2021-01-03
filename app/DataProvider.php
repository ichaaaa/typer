<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class DataProvider extends Model
{
	public function scopeActive($query)
	{
		return $query->where('active',true);
	}
}
