<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExtraQuestion extends Model
{
    protected $table = 'extra_questions';
    protected $fillable = ['description', 'helper', 'match_id', 'question_type_id', 'typer_id'];
    
}
