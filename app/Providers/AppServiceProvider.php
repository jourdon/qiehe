<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Link;
use App\Observers\CategoryObserver;
use App\Observers\LinkObserver;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \App\Models\User::observe(\App\Observers\UserObserver::class);
		\App\Models\Reply::observe(\App\Observers\ReplyObserver::class);
        \App\Models\Post::observe(\App\Observers\PostObserver::class);
        Link::observe(LinkObserver::class);
        Category::observe(CategoryObserver::class);

        View::composer('layouts._header', 'App\Http\ViewComposers\CategoryViewComposer');
        View::composer('posts._sidebar', 'App\Http\ViewComposers\SidebarViewComposer');

        Carbon::setLocale('zh');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //本地启用
        if (app()->isLocal()) {
            $this->app->register(\VIACreative\SudoSu\ServiceProvider::class);
        }
    }
}
