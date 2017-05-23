<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\ImportCsvWords'        => [
            'App\Listeners\CsvWordTranslate',
        ],
        'App\Events\ControllerConstructor' => [
            'App\Listeners\AuthCheck',
        ],
        'App\Events\ReturnResponse'        =>[
            'App\Listeners\ContentNegotiatedResponse'
        ]
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
