<?php
// nova-components/nova-stripe-subscription-manager/src/UpdateSubscription.php

namespace Deep12650\NovaStripeSubscriptionManager;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Text;
use Stripe\Subscription;

class UpdateSubscription extends Action implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public $withoutConfirmation = false;

    /**
     * Perform the action on the given models.
     *
     * @param \Laravel\Nova\Fields\ActionFields $fields
     * @return mixed
     */
    public function handle(ActionFields $fields)
    {
        $subscriptionIds = $fields->subscription_ids;

        foreach ($subscriptionIds as $subscriptionId) {
            $subscription = Subscription::retrieve($subscriptionId);
            // Implement your logic to update subscription, e.g., change plan
        }

        return $this->message('Subscriptions updated successfully!');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Text::make('Subscription IDs')->rules('required'),
        ];
    }
}
