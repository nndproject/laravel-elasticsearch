<?php

namespace App\Observers;
use App\Jobs\IndexLpseElasticsearchJob;
use App\Jobs\RemoveLpseElasticSearchJob;
use App\Models\Lpse;

class LpseObserver
{
    /**
     * Handle the Lpse "created" event.
     *
     * @param  \App\Models\Lpse  $lpse
     * @return void
     */
    public function created(Lpse $lpse)
    {
        dispatch(new IndexLpseElasticsearchJob($lpse));
    }

    /**
     * Handle the Lpse "updated" event.
     *
     * @param  \App\Models\Lpse  $lpse
     * @return void
     */
    public function updated(Lpse $lpse)
    {
        // hapus terlebih dahulu lalu input
            dispatch(new RemoveLpseElasticSearchJob($lpse->id));
            dispatch(new IndexLpseElasticsearchJob($Lpse));

        // if ($Lpse->is_active) {
            // dispatch(new IndexLpseElasticsearchJob($Lpse));
        // } else {
            // dispatch(new RemoveLpseElasticsearchJob($lpse->id));
        // }
    }

    /**
     * Handle the Lpse "deleted" event.
     *
     * @param  \App\Models\Lpse  $lpse
     * @return void
     */
    public function deleted(Lpse $lpse)
    {
        dispatch(new RemoveLpseElasticSearchJob($lpse->id));
    }

    /**
     * Handle the Lpse "restored" event.
     *
     * @param  \App\Models\Lpse  $lpse
     * @return void
     */
    public function restored(Lpse $lpse)
    {
        //
    }

    /**
     * Handle the Lpse "force deleted" event.
     *
     * @param  \App\Models\Lpse  $lpse
     * @return void
     */
    public function forceDeleted(Lpse $lpse)
    {
        dispatch(new RemoveLpseElasticSearchJob($lpse->id));
    }
}
