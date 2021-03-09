<?php

namespace App\Jobs;

use App\Notifications\UserTyperApplicationNotification;
use App\Services\CompetitionService;
use App\Typer;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class ApplicationToTyperNotification implements ShouldQueue
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

        $admins = User::admin()->get();
        
        foreach($admins as $admin)
        {
            $admin->notify(new UserTyperApplicationNotification($this->user, $competition, $this->typer));
        }
    }
}
