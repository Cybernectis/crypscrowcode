<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notification;
use Auth;
class NotificationController extends Controller
{
    public function get() {
        // $notification['data'] = Auth::user()->notifications; 

       $notification['data'] =  Auth::user()->notifications->map(function ($item) {
            $item['time'] = \Carbon\Carbon::createFromTimeStamp(strtotime($item->created_at))->diffForHumans();
            return $item;
          });
        $notification['count'] = count(Auth::user()->unreadNotifications);
        return $notification;
    }

    public function read(Request $request) {
    	$unreadNotification = Auth::user()->unreadNotifications()->find($request->id);
    	if(!empty($unreadNotification))
    	{
    		$unreadNotification->markAsRead();
    	}
        // Auth::user()->unreadNotifications()->find($request->id)->markAsRead();
        return 'success';
    }
}
