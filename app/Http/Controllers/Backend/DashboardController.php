<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Group;
use \Voerro\Laravel\VisitorTracker\Facades\VisitStats;
/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
    	$usercount 		= User::where('id', "<>", auth()->user()->id)->count();

        $countryData = VisitStats::query()
                ->visits()
                ->orderBy('visitors_count', 'DESC')
                ->groupBy("country_code")
                ->get();
        // echo "<pre>";
        // print_r($countryData);
        // die();
    	$femaleCount 	= User::where('id', "<>", auth()->user()->id)->where('gender', 'female')->count();
    	$maleCount 	= User::where('id', "<>", auth()->user()->id)->where('gender', 'male')->count();
    	$tradescount 	= Group::get()->count();
        return view('backend.dashboard', compact('usercount', 'tradescount', 'femaleCount', 'maleCount', 'countryData'));
    }
}
