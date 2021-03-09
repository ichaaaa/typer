<?php

namespace App;

use App\DataProvider;
use App\Services\CompetitionService;
use App\User;
use App\VisibilityType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class Typer extends Model
{
	private $service;

    protected $table = 'typer';
    protected $fillable = ['name', 'description', 'competition_id', 'start_date', 'data_provider_id', 'visibility_type_id', 'membership_fee_amount', 'membership_fee_currency', 'awarded_positions', 'status'];

	public function visibility()
	{
		return $this->hasOne(VisibilityType::class, 'id', 'visibility_type_id');
	}

	public function users()
	{
		return $this->belongsToMany(User::class, 'typers_users')->withPivot('confirmed', 'banned', 'payed', 'verified', 'token', 'verified_at');
	}

	public function verifiedUsers()
	{
		return $this->belongsToMany(User::class, 'typers_users')->wherePivot('verified', 1);
	}

	public function verifiedUser($user)
	{
		return $this->verifiedUsers->contains($user);
	}

	public function confirmedUsers()
	{
		return $this->belongsToMany(User::class, 'typers_users')->wherePivot('confirmed', 1);
	}

	public function confirmedUser($user)
	{
		return $this->confirmedUsers->contains($user);
	}

	public function bannedUsers()
	{
		return $this->belongsToMany(User::class, 'typers_users')->wherePivot('banned', 1);
	}

	public function bannedUser($user)
	{
		return $this->bannedUsers->contains($user);
	}

	public function hasUser($user)
	{
		return $this->users->contains($user);
	}


	public function getCompetition($service)
	{
        $competitions = $service->findAll();

        foreach($competitions as $competition)
        {
        	if($competition->getId() === $this->competition_id)
        	{
        		return $competition;
        	}
        }
	}

	public function scopePrivate($query)
	{
		return $query->where('visibility_type_id', 1);
	}

	public function scopePublic($query)
	{
		return $query->where('visibility_type_id', 2);
	}

	public function scopeActive($query)
	{
		return $query->where('status', 1);
	}

	public function getStartDateAttribute($value)
	{
		return Carbon::parse($value)->format('Y-m-d');
	}



}