<?php

namespace App\Observers;

use App\DataProvider;
use App\Typer;

class TyperObserver
{
    public function saving(Typer $typer)
    {
        $typer->data_provider_id = DataProvider::active()->firstOrFail()->id;
    }
}
