<?php

namespace App\Http\Composers;

use Illuminate\View\View;
use App\PaymentMethod;
/**
 * Class OfferTypeComposer.
 */
class PaymentMethodComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     *
     * @return void
     */
    public function compose(View $view)
    {
        $paymentMethods = PaymentMethod::all();
        $view->with('paymentMethods', $paymentMethods);
    }
}
