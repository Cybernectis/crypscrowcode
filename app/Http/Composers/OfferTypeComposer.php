<?php

namespace App\Http\Composers;

use Illuminate\View\View;
use App\OfferType;
/**
 * Class OfferTypeComposer.
 */
class OfferTypeComposer
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
        $offertype = OfferType::all();
        $view->with('offertype', $offertype);
    }
}
