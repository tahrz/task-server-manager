<?php

namespace App\Providers;

use App\Parser\ItemParserInterface;
use App\Parser\JsonItemParser;
use App\Repository\EloquentItemRepository;
use App\Repository\ItemRepositoryInterface;
use App\Service\CollectionPaginator;
use App\Service\PaginatorInterface;
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
        $this->app->bind(ItemParserInterface::class, JsonItemParser::class);
        $this->app->bind(ItemRepositoryInterface::class, EloquentItemRepository::class);
        $this->app->bind(PaginatorInterface::class, CollectionPaginator::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
