<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisibilityType extends Model
{
    protected $table = 'visibility_types';
	public $timestamps = false;
    protected $fillable = ['type'];

    public function getPrivateAttribute()
    {
    	return $this->id == 1;
    }

}
