<?php

namespace App;

use App\Bet;
use Illuminate\Database\Eloquent\Model;

class BetResult extends Model
{
    protected $table = 'bets_results';

    public function bet()
    {
    	return $this->hasOne(Bet::class);
    }
}
