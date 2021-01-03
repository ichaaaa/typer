<?php

namespace App\Observers;

use App\DataProvider;

class DataProviderObserver
{
    /**
     * Handle the data provider "created" event.
     *
     * @param  \App\DataProvider  $dataProvider
     * @return void
     */
    public function created(DataProvider $dataProvider)
    {
        
    }

    /**
     * Handle the data provider "updated" event.
     *
     * @param  \App\DataProvider  $dataProvider
     * @return void
     */
    public function updated(DataProvider $dataProvider)
    {
        if($dataProvider->active)
        {
            DataProvider::where('id', '!=', $dataProvider->id)->update(['active'=>false]);
        }
    }

    /**
     * Handle the data provider "deleted" event.
     *
     * @param  \App\DataProvider  $dataProvider
     * @return void
     */
    public function deleted(DataProvider $dataProvider)
    {
        //
    }

    /**
     * Handle the data provider "restored" event.
     *
     * @param  \App\DataProvider  $dataProvider
     * @return void
     */
    public function restored(DataProvider $dataProvider)
    {
        //
    }

    /**
     * Handle the data provider "force deleted" event.
     *
     * @param  \App\DataProvider  $dataProvider
     * @return void
     */
    public function forceDeleted(DataProvider $dataProvider)
    {
        //
    }
}
