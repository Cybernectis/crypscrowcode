<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\Frontend\forum\Sendforum;
use App\Http\Requests\Frontend\forum\SendforumRequest;

/**
 * Class forumController.
 */
class forumController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('frontends.forum');
    }

    /**
     * @param SendforumRequest $request
     *
     * @return mixed
     */
    public function send(SendforumRequest $request)
    {
        Mail::send(new Sendforum($request));

        return redirect()->back()->withFlashSuccess(__('alerts.frontend.forum.sent'));
    }
}
