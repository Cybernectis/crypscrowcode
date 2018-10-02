<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Conversation;
use App\Trades;
use App\Group;
use App\AdminWalletDetail;
use App\LocalCoin;
use Intervention\Image\ImageManagerStatic as Image;

use App\Events\NewMessage;
class OffersController extends Controller
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
        $id         = base64_decode($id);
        $trade      = Trades::findOrFail($id);

        //echo "<pre>";print_r($trade);die;
        return view("frontends.mytrades.offer", compact("trade"));
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


    public function chatConverstation($id)
    {
        // $conversations = Conversation::where("group_id",$id)->get();
        // $groups = [];
        $userIdArray    = array();
        $error          = "";
        $groups         = Group::where("uuid",$id)->first();
        $error = 0;
        if(!empty($groups))
        {
            $groups = $groups->load("tradeData");
            $userId =  $groups->users;
           
            foreach ($userId as $key => $value) {
               
                $userIdArray[] = $value->pivot->user_id;
                
            }
            if (in_array(auth()->user()->id, $userIdArray)) {
                $error = 1;
            }
        }
        
        
        $user = auth()->user();
        $adminwalletdetail = '';
        if(!empty($groups->tradeData->local_coins_id))
        {

            $adminwalletdetail = AdminWalletDetail::where('local_coins_id','=',$groups->tradeData->local_coins_id)->first();
        }
        return view("frontends.mytrades.chat", compact("groups", "user", "error","adminwalletdetail"));
    }


    public function imageUpload(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'image' => 'required|image64:jpeg,jpg,png'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);
        } else {
            $imageData = $request->get('image');
            $fileName = \Carbon\Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
            Image::make($request->get('image'))->save(public_path('images/').$fileName);

            $conversation = new Conversation;
            $conversation->message =  "<a target='__blank' href='".public_path('images/').$fileName."'>".$fileName."</a>"; 
            $conversation->group_id = $request->group_id;
            $conversation->user_id = auth()->user()->id;
            $conversation->save();

            broadcast(new NewMessage($conversation))->toOthers();
            return response()->json(['error'=>false]); 
        }
    }


    public function getOffersByType(Request $request, $type)
    {
        if($type == "Buy")
        {
            $id = 2;
        }else{
            $id = 1;
        }
        $trades = Trades::where("offer_type_id", $id)->where("is_paused", 0)->latest()->paginate(10);
        $html='';
        foreach ($trades as $btrades) {
            $html.= view("frontends.parts.myoffers.singlerowoffers", compact("btrades"));
        }
        if ($request->ajax()) {
            return $html;
        }
        return view("frontends.myoffers.offers", compact("trades"));

    }
}
