<?php

namespace App\Http\Composers;

use Illuminate\View\View;
use App\ExchangeRate;
/**
 * Class ExchangeRateComposer.
 */
class ExchangeRateComposer
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
        $exchangeRates = ExchangeRate::all();
        $view->with('exchangeRates', $exchangeRates);
    }
}
