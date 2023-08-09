<?php


namespace App\Providers;

use App\Models\Lpse;
use App\Observers\LpseObserver;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $config = config('database.connections.elasticsearch.hosts');
        $this->app->singleton(Client::class, function () use ($config) {
            return ClientBuilder::create()
            ->setHosts([$config['host'].':'.$config['port']])
            ->setBasicAuthentication($config['username'], $config['password'])
            // ->setApiKey('ApiKey', 'Z2FrNzJJa0JlcEQtRzJVcmhNR1I6QkwzeUlHZGFUUC1Uc1gtOHh6SEtFUQ==')
            ->build();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Lpse::observe(LpseObserver::class);
    }
}
