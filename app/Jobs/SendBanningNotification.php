<?php

namespace App\Jobs;

use App\Notifications\BanUserFromTyperNotification;
use App\Services\CompetitionService;
use App\Typer;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendBanningNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $typer;
    protected $user;
    protected $reason;
    /**
     * Create a new job instance.
     *
     * @return void
     */

    public function __construct(Typer $typer, User $user, $reason)
    {
        $this->typer = $typer;
        $this->user = $user;
        $this->reason = $reason;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $competition = $this->typer->getCompetition(new CompetitionService());
        $this->user->notify(new BanUserFromTyperNotification($competition, $this->reason));
    }
}
