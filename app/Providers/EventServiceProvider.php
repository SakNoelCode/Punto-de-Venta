<?php

namespace App\Providers;

use App\Events\CreateCompraDetalleEvent;
use App\Events\CreateVentaDetalleEvent;
use App\Events\CreateVentaEvent;
use App\Listeners\CreateMovimientoVentaCajaListener;
use App\Listeners\CreateRegistroCompraCardexListener;
use App\Listeners\CreateRegistroVentaCardexListener;
use App\Listeners\EnviarEmailClienteVentaListener;
use App\Listeners\UpdateInventarioCompraListener;
use App\Listeners\UpdateInventarioVentaListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CreateCompraDetalleEvent::class => [
            CreateRegistroCompraCardexListener::class,
            UpdateInventarioCompraListener::class
        ],
        CreateVentaDetalleEvent::class => [
            CreateRegistroVentaCardexListener::class,
            UpdateInventarioVentaListener::class
        ],
        CreateVentaEvent::class => [
            CreateMovimientoVentaCajaListener::class,
            EnviarEmailClienteVentaListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
