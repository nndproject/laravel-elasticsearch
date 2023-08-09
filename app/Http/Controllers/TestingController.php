<?php

namespace App\Http\Controllers;
use Elastic\Elasticsearch\Client as ElasticClient;
use Illuminate\Http\Request;

class TestingController extends Controller
{
    public $elasticClient;

    public function __construct(ElasticClient $client) {
        $this->elasticClient = $client;
    }

    public function index() {
        // https://www.elastic.co/guide/en/elasticsearch/client/php-api/current/index_management.html
        // pastikan structur data yang di masukkan sama
        // membuat index / indices
        $params = [
            'index' => 'datalpse_com_lpse',
            'body' => [
                'settings' => [
                    'number_of_shards' => 1,
                    'number_of_replicas' => 0
                ]
            ]
        ];
        $response = $this->elasticClient->indices()->create($params);
        // end membuat index / indices

        // update data partial document
        // update partial tidak disarankan, lebih baik index update
      /*   $params = [
            'index' => 'my_index',
            'id'    => 'my_id',
            'body'  => [
                'doc' => [
                    'new_field' => 'abc'
                ]
            ]
        ];

        // Update doc at /my_index/_doc/my_id
        $response = $client->update($params); */
        // end update data partial document


        /* $params = [
            'index' => 'datalpsecom_lpse',
            'id'    => 1,
            'body'  => [
                'foo'   => 'bar'
            ]
        ];

        $response = $this->elasticClient->index($params); */
        dd($response);
    //    return response()->json(json_decode($response->getBody()));
    }
}
