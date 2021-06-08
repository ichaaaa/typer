<?php

namespace App;

use App\ExtraQuestion;
use Illuminate\Database\Eloquent\Model;

class Range extends Model
{
    protected $table = "ranges";
    protected $fillable = ['extra_question_id', 'value'];

    public function extraQuestion()
    {
    	return $this->belongsTo(ExtraQuestion::class);
    }
}
