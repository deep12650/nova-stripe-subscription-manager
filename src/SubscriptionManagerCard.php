<?php

namespace Deep12650\NovaStripeSubscriptionManager;

use Laravel\Nova\Card;

class SubscriptionManagerCard extends Card
{
    public function name()
    {
        return 'Subscription Manager';
    }

    public function component()
    {
        return 'subscription-manager-card';
    }
}
