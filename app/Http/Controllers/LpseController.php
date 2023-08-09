<?php

namespace App\Http\Controllers;
use App\Models\Lpse;
use Elastic\Elasticsearch\Client as ElasticClient;
use Illuminate\Http\Request;

class LpseController extends Controller
{
    public $elasticClient;

    public function __construct(ElasticClient $client) {
        $this->elasticClient = $client;
    }

    public function index() {

        /* $data = Lpse::latest()->get();

            foreach ($data as $item) {
                $params['body'][] = [
                    'index' => [
                        '_index' => 'datalpse_com_lpse',
                        '_id' => $item->id,
                    ]
                ];

                $params['body'][] = [
                    'id'    => $item->id,
                    'name'    => $item->name,
                    'address'    => $item->address,
                    'url'    => $item->url,
                    'province_id'    => $item->province_id,
                    'status'    => $item->status,
                    'post_by'    => $item->post_by,
                    'img'    => $item->img,
                    'deleted_at'    => $item->deleted_at,
                    'created_at'    => $item->created_at,
                    'updated_at'    => $item->updated_at,
                ];

            }

        // indexing / input to elasticsearch
        $response = $this->elasticClient->bulk($params); */

         /* $params = ['index' => 'datalpse_com_lpse'];
        $response = $this->elasticClient->indices()->getSettings($params); */

        // Get doc at /datalpse_com_lpse/_doc/lpse_id
        $params = [
            'index' => 'datalpse_com_lpse',
            'id'    => '150'
        ];

        try {
            $response = $this->elasticClient->get($params);
        } catch (\Exception $e) {
            return \response()->json([
                'success'   => false,
                'message'   => 'UH! Sorry, '. $e->getCode()
                ], 404);
        }

        return \response()->json($response->asArray());

       /*  // Input data with job for elasticsearch
        $data = new Lpse();
        $data->name = 'lpse testing';
        $data->address = 'Jl. Tanjungpura No. 367 Kec. Sukadana Kab. Kayong Utara 78852';
        $data->url = 'http://www.lpse.kayongutarakab.go.id';
        $data->province_id = '13';
        $data->status = '1';
        $data->post_by = '1';
        $data->img = 'images/kldi/62b563f646e29_300x300.png';
        $data->save();

        dd($data); */

    }
    public function create() {

        // Input data with job for elasticsearch
        $data = new Lpse();
        $data->name = 'lpse testing';
        $data->address = 'Jl. Tanjungpura No. 367 Kec. Sukadana Kab. Kayong Utara 78852';
        $data->url = 'http://www.lpse.kayongutarakab.go.id';
        $data->province_id = '13';
        $data->status = '1';
        $data->post_by = '1';
        $data->img = 'images/kldi/62b563f646e29_300x300.png';
        $data->save();

        dd($data);
    }

    public function delete() {

        // Input data with job for elasticsearch
        $data = Lpse::where('id', '>', 705)->orderBy('id', 'asc')->first();
        $data->delete();

        dd('delete successfully '. $data->id);
    }
}
