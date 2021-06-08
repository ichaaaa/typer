<?php

namespace App;

use App\ExtraQuestion;
use Illuminate\Database\Eloquent\Model;

class ExtraQuestionChoice extends Model
{
    protected $table = "extra_question_choices";
    protected $fillable = ['extra_question_id', 'choice'];

    public function extraQuestion()
    {
    	return $this->belongsTo(ExtraQuestion::class);
    }
}
