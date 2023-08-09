<?php

namespace App\Jobs;

use Elastic\Elasticsearch\Client as ElasticClient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class RemoveLpseElasticSearchJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $lpseId;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public function __construct($lpseId)
    {
        $this->lpseId = $lpseId;
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
            'id' => $this->lpseId,
        ];

        try {
            $client->delete($params);
        } catch (Missing404Exception $exception) {
            Log::erro('error elasticsearch'.$exception);
        }
    }
}
