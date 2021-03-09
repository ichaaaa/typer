<?php

namespace App\Jobs;

use App\Notifications\InviteUserToTyperNotification;
use App\Services\CompetitionService;
use App\Typer;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class InvitationNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $typer;
    protected $user;
    public function __construct(Typer $typer, User $user)
    {
        $this->typer = $typer;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $token = (string) Str::uuid();
        $competition = $this->typer->getCompetition(new CompetitionService());

        $this->typer->users()->attach($this->user->id, ['token' => $token]);
        $this->user->notify(new InviteUserToTyperNotification($competition, $token, $this->typer));
    }
}
