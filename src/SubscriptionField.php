<?php

namespace Deep12650\NovaStripeSubscriptionManager;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;
use Stripe\Stripe;
use Stripe\Subscription;

class SubscriptionField extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'text'; // Use the 'text' component for displaying plans

    /**
     * Resolve the field's value.
     *
     * @param mixed $resource
     * @param mixed $attribute
     * @return mixed
     */
    public function resolve($resource, $attribute = null)
    {
        $user = request()->user();
        $stripeCustomerId = $user->stripe_customer_id;

        if ($stripeCustomerId) {
            // Retrieve the Stripe key from the Laravel configuration
            $stripeKey = config('services.stripe.secret');

            // Set the Stripe key
            Stripe::setApiKey($stripeKey);

            // Now, you can use the Stripe API to retrieve subscriptions
            $subscriptions = Subscription::all(['customer' => $stripeCustomerId]);

            // Extract and display the plans
            $plans = [];

            foreach ($subscriptions as $subscription) {
                foreach ($subscription->items->data as $item) {
                    $plans[] = $item->plan->nickname;
                }
            }

            $this->value = implode(', ', array_unique($plans));
        }
    }
}
