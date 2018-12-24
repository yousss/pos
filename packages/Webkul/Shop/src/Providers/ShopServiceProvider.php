<?php
namespace Webkul\Shop\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Router;
class ShopServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        // $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }
}