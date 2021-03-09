<?php

namespace App\Jobs;

use App\Notifications\UserTyperConfirmNotification;
use App\Services\CompetitionService;
use App\Typer;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ConfirmationNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $typer;
    protected $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */

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
        $competition = $this->typer->getCompetition(new CompetitionService());
        $this->user->notify( new UserTyperConfirmNotification($competition, $this->typer));
    }
}
