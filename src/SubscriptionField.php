<?php

namespace Deep12650\NovaStripeSubscriptionManager;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;
use Stripe\Stripe;
use Stripe\Subscription;

class SubscriptionField extends Field
{
    public $component = 'subscription-field';

    /**
     * Resolve the given attribute from the given resource.
     *
     * @param mixed $resource
     * @param string $attribute
     * @return mixed
     */
    public function resolveAttribute($resource, $attribute)
    {
        $user = app(NovaRequest::class)->user();
        $stripeCustomerId = $user->stripe_customer_id;

        if ($stripeCustomerId) {
            // Retrieve the Stripe key from the Laravel configuration
            $stripeKey = config('services.stripe.secret');

            // Set the Stripe key
            Stripe::setApiKey($stripeKey);

            // Now, you can use the Stripe API to retrieve subscriptions
            $subscriptions = Subscription::all(['customer' => $stripeCustomerId]);

            return $subscriptions;
        }

        return null;
    }
}
