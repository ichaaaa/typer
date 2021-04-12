<?php

namespace App;

use App\Bet;
use App\Permissions\HasPermissionsTrait;
use App\Typer;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;



class User extends Authenticatable
{
    use Notifiable;
    use HasPermissionsTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function typers()
    {
        return $this->belongsToMany(Typer::class, 'typers_users')->withPivot('confirmed', 'banned', 'payed', 'verified', 'token', 'verified_at');
    }

    public function bets()
    {
        return $this->hasMany(Bet::class);
    }

    public function verifiedTyper($typer_id)
    {
        return $this->typers()->wherePivot('typer_id', $typer_id);
    }

    public function bannedTypers()
    {
        return $this->typers()->wherePivot('banned', 1);
    }


    public function visibleTypers()
    {
        $confirmedTypers = $this->typers()
                                ->active()
                                ->wherePivot('banned', 0)
                                ->where(function($query){
                                    $query->where('confirmed', 1)->orWhere('verified', 1);
                                });

        // $bannedTypers = $this->bannedTypers;
        //$publicTypers = Typer::public()->active()->get();
        //$visibleTypers = $publicTypers->diff($this->typers()->public()->wherePivot('banned', 1)->get());
 
        return $confirmedTypers;
    }

    public function availableTypers()
    {
        $publicTypers = Typer::public()->active()->get();
        $availableTypers = $publicTypers->diff($this->typers()->public()->get());
        return $availableTypers;
    }

    public function notConfirmedTypers()
    {
        $typers = $this->typers()
                            ->active()
                            ->wherePivot('banned', 0)
                            ->wherePivot('confirmed', 0)
                            ->wherePivot('verified', 0);
        return $typers;
    }

    public function scopeAdmin($query)
    {
        return $query->whereHas('roles', function ($query) {
             $query->where('slug', '=', 'developer');
        });
    }
}
