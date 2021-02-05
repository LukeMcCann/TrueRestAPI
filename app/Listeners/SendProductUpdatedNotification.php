<?php

namespace App\Listeners;

use App\Events\ProductUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Product;

class SendProductUpdatedNotification
{
    protected $event;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(ProductUpdated $event)
    {
        $this->event = $event;
    }

    /**
     * Handle the event.
     *
     * @param  ProductUpdated  $event
     * @return void
     */
    public function handle(ProductUpdated $event)
    {
        if ($event->product->quantity == 0 && $event->product->isAvailable()) {
            $this->product->status = Product::UNAVAILABLE_PRODUCT;

            $this->product->save();
        }
    }
}
