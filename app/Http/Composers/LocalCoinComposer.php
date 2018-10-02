<?php

namespace App\Http\Composers;

use Illuminate\View\View;
use App\LocalCoin;
/**
 * Class OfferTypeComposer.
 */
class LocalCoinComposer
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
        $localCoin = LocalCoin::all();
        $view->with('localCoin', $localCoin);
    }
}
