<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        //
        DB::listen(function(QueryExecuted $query) {
            File::append(
                storage_path('/logs/query.log'),
                '['.date('Y-m-d h:i:s').']'."\n".$query->sql . ' [' . implode(', ', $query->bindings) . ']' . '[' . $query->time . ']' . PHP_EOL
            );
        });
    }
}
