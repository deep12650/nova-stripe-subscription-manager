// nova-components/nova-stripe-subscription-manager/src/UpdateSubscription.php

<?php

namespace Deep12650\NovaStripeSubscriptionManager;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Stripe\Subscription;

class UpdateSubscription extends Action implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public function handle(ActionFields $fields, $models)
    {
        $subscriptionIds = $fields->subscription_ids;

        foreach ($subscriptionIds as $subscriptionId) {
            $subscription = Subscription::retrieve($subscriptionId);
            // Implement your logic to update subscription, e.g., change plan
        }

        return Action::message('Subscriptions updated successfully!');
    }

    public function fields()
    {
        return [
            Text::make('Subscription IDs')->rules('required'),
        ];
    }
}
