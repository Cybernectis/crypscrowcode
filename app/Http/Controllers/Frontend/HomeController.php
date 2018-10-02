<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Auth\User; 
use App\Trades;
use DB;
use App\Blogs;
/**
 * Class HomeController.
 */
class HomeController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
    	
       
        return view('frontends.index');
    }

    public function faq(){
    	return view('frontends.faq');
    }

    
    public function exchange(){
        return view('frontends.exchange');
    }
    public function blog(){
        $blogs = Blogs::all();
        return view('frontends.blogs.index', compact('blogs'));
    }

    public function blogBySlug($slug)
    {
        $blog = Blogs::where("blog_slug", $slug)->firstOrFail();
        return view('frontends.blogs.show', compact('blog'));
    }
    public function getUserProfile($userName)
    {
        $user = User::where("username", $userName)->firstOrFail();
        return view("frontends.user.profile", compact("user"));
    }

    public function search(Request $request)
    {
         $trades = Trades::where(function($query) use($request){
                                $search = $request->country;
                                if($request->country !=  0 || $request->country !=  "0")
                                    $query->where("city",'like', "%".$search."%");
                                if(\Auth::check())
                                    $query->where("user_id","<>", \Auth::id());
                                if($request->coins != 0 || $request->coins !=  "0")
                                    $query->where("local_coins_id", $request->coins);
                                if($request->paymentmethod != 0 || $request->paymentmethod !=  "0")
                                    $query->where("payment_method_id", $request->paymentmethod);
                            })
                            ->where("is_paused", 0)
                            ->limit(10)
                            ->orderBy($request->sort_by)
                            ->get();
       
            if($request->buysell ==  0)
            {
                

                $buyTrades  =   $trades->filter(function ($value, $key) {
                                    if($value->offer_type_id == 2)
                                    {
                                        return $value;
                                    }
                                });
                $sellTrades =   $trades->filter(function ($value, $key) {
                                    if($value->offer_type_id == 1)
                                    {
                                        return $value;
                                    }
                                });

                return view('frontends.parts.index.bothsellbuy', compact("buyTrades", "sellTrades"));
            }else{
                $singletrades =   $trades->filter(function ($value, $key) use($request) {
                                   
                                    if($value->offer_type_id != $request->buysell)
                                    {
                                        return $value;
                                    }
                                });
                if($request->buysell == 1)
                {
                    $type = "Buy";
                    $btnType = "Sellers";
                }else{
                    
                    $type = "Sell";
                    $btnType = "Buyers";
                }
                return view('frontends.parts.index.singletype', compact("singletrades", 'type', 'btnType'));
            }
    }


    public function deleteChat()
    {
        $groups =  \DB::table('groups')
            ->where('status', "Cancelled")
            ->whereRaw('Date(cancel_date) = CURDATE()')
            ->get();
        foreach ($groups as $key => $value) {
            $conversations =  \DB::table('conversations')
            ->where('group_id', $value->id)
            ->delete();

            echo "<pre>";
            print_r($conversations);
        }
    }
}
