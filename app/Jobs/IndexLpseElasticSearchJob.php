<?php

namespace App\Jobs;

use App\Models\Lpse;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


use Elastic\Elasticsearch\Client as ElasticClient;

class IndexLpseElasticSearchJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $lpse;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public function __construct(Lpse $lpse)
    {
        $this->lpse = $lpse;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ElasticClient $client)
    {
        $params = [
            'index' => 'datalpse_com_lpse',
            'id' => $this->lpse->id,
            'body' => $this->lpse->toArray(),
        ];

        $client->index($params);
    }
}
