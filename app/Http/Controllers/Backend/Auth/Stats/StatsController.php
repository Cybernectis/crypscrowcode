<?php

namespace App\Http\Controllers\Backend\Auth\Stats;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Voerro\Laravel\VisitorTracker\Models\Visit;
use Carbon\Carbon;
use Voerro\Laravel\VisitorTracker\Facades\VisitStats;


class StatsController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($id == 'all')
        {
            return SELF::allRequests();
        }
        elseif ($id == 'visits') {
           return SELF::visits();
        }
        elseif ($id == 'login-attempts') {
           return SELF::loginAttempts();
        }
        elseif ($id == 'users') {
           return SELF::users();
        }
        elseif ($id == 'unique') {
           return SELF::unique();
        }
        elseif ($id == 'countries') {
           return SELF::countries();
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function allRequests()
    {
        
        return view('backend.auth.stats.allrequest', array_merge([
            'visits' => VisitStats::query()
                ->visits()
                ->withUsers() 
                ->latest()
                ->paginate(config('visitortracker.results_per_page', 15)),
            'visitortrackerSubtitle' => 'All Requests', 
        ]));
    }

    public function visits()
    {
        return view('backend.auth.stats.visits', array_merge([
            'visits' => VisitStats::query()
                ->visits()
                ->withUsers()
                ->latest()
                ->except(['ajax', 'bots', 'login_attempts'])
                ->paginate(config('visitortracker.results_per_page', 15)),
            'visitortrackerSubtitle' => 'Page Visits',
        ]));
    }


    public function loginAttempts()
    {
        return view('backend.auth.stats.visits', array_merge([
            'visits' => VisitStats::query()
                ->visits()
                ->withUsers()
                ->latest()
                ->loginAttempts()
                ->paginate(config('visitortracker.results_per_page', 15)),
            'visitortrackerSubtitle' => 'Login Attempts',
        ]));
    }

    public function unique()
    {
        return $this->groupedVisits('unique', 'ip', 'Unique Visitors');
    }

    public function users()
    {
        return $this->groupedVisits('users', 'user_id', 'Registered Users');
    }
    public function countries()
    {
        return $this->groupedVisits('countries', 'country_code', 'Countries');
    }

    protected function groupedVisits($view, $groupBy, $subtitle)
    {
        return view("backend.auth.stats.$view", array_merge([
            'visits' => VisitStats::query()
                ->visits()
                ->withUsers()
                ->except(['ajax', 'bots', 'login_attempts'])
                ->orderBy('visitors_count', 'DESC')
                ->groupBy($groupBy)
                ->paginate(config('visitortracker.results_per_page', 15)),
            'visitortrackerSubtitle' => $subtitle, 
        ]));
    }
}
