<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFive();

        // now()->addMinutes(5)
        // Cache::forget('topUsers');

        $topUsers = Cache::remember('topUsers', 5, function () {
            Log::info('Creating topUsers cache');
            return User::withCount('ideas')
            ->orderBy('ideas_count', 'DESC')
            ->take(5)->get();

        });

        //Cache::flush();
        Log::info('Using topUsers cache');
        View::share(
            'topUsers',
            // User::withCount('ideas')
            // ->orderBy('ideas_count', 'DESC')
            // ->take(5)->get()
            $topUsers,
        );

    }
}
