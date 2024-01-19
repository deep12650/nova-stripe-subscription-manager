<?php

namespace Deep12650\NovaStripeSubscriptionManager;

use Laravel\Nova\Nova;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\ServiceProvider;

class NovaStripeSubscriptionManagerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Nova::serving(function (ServingNova $event) {
            Nova::tools([
                new SubscriptionManagerCard,
            ]);

            Nova::fields([
                SubscriptionField::make(),
            ]);

            Nova::actions([
                UpdateSubscription::make(),
            ]);
        });
    }

    public function register()
    {
        //
    }
}
