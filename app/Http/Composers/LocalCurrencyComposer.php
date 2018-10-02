<?php

namespace App\Http\Composers;

use Illuminate\View\View;
use App\LocalCurrency;
/**
 * Class OfferTypeComposer.
 */
class LocalCurrencyComposer
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
        $localCurrency = LocalCurrency::all();
        $view->with('localCurrency', $localCurrency);
    }
}
