<?php

namespace App;

use App\BetResult;
use App\Objects\Game;
use App\Typer;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Bet extends Model
{
    protected $table = 'bets';

    public function typer()
    {
    	return $this->belongsTo(Typer::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function betResult()
    {
        return $this->hasOne(BetResult::class);
    }

    public function scopeMatch($query, $typer_id, Game $match)
    {
        if(!self::canBet($match))
        {
            return $query->where('typer_id', $typer_id)->where('match_id', $match->getId());
        }
        else
        {
            return null;
        }
    }


    public static function canBet(Game $game)
    {
    	if($game->getDate() <= Carbon::now()->format('Y.m.d H:i:s'))
    	{
    		return false;
    	}
    	return true;
    }

}
