<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use SocialiteProviders\Manager\SocialiteWasCalled;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        //'App\Events\Event' => [
        //    'App\Listeners\EventListener',
        //],
        'App\Events\BlogView' => [
            'App\Listeners\BlogViewListener',
        ],
        //QQ登录
        SocialiteWasCalled::class => [
            'SocialiteProviders\QQ\QqExtendSocialite@handle'
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
