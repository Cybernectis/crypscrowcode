<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Group;
use App\Events\GroupCreated;
use Illuminate\Notifications\Notifiable;
use App\Notifications\TradeOpen;
use App\Models\Auth\User;
use App\Trades; 
use Helper;
use App\Rewards;
class GroupController extends Controller
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
        $group                      = new Group;
        $group->name                = $request->name;
        $group->amount              = $request->amount;
        $group->local_coins_id      = $request->local_coins_id;
        $group->trades_id           = $request->trade_id;
        $group->status              = "Waiting for escrow";
        $group->coin_quantity       = $request->coin_quantity;
        $group->is_dispute          = 0; 
        $group->save();
        $users                      = collect($request->users);
        $group->encrpted_id         = base64_encode($group->id);
        $userDetails                = User::find($request->users);
        $coinName                   = Helper::getLocalCoinName($request->local_coins_id, "name");
        if($request->offer_type_id == 1)
        {
            $purchaseType = "selling";
        }else{
            $purchaseType = "buying";
        }
        $data['message'] = auth()->user()->username." ".$purchaseType." ".$coinName." with  ".$request->coin_quantity.".";
       
        $data['testurl'] = url("/trade/".$group->uuid);
        // $userDetails->notify(new TradeOpen($data));
         \Notification::send($userDetails, new TradeOpen($data));
        $users->push(auth()->user()->id);
       
        $group->users()->attach($users);
        broadcast(new GroupCreated($group))->toOthers();
        
        return $group;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { 
        //
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
        $group = Group::find($id);
        //We are using update function to cancel trade only
        if(!empty($group))
        {

            if($request->type == 'dispute')
            {
                $group->is_dispute =  1;
                //need to send mail to admin
            }elseif($request->type == 'cancel')
            {
                $group->status = "Cancelled";
                $group->cancel_date = \Carbon\Carbon::now()->addDays(8);
            }elseif($request->type == 'payment')
            {
              
                $group->status = "Payment Pending";
            }
            elseif($request->type == 'deposit')
            {              
                $group->status = "Acknowledge Payment";
            }
            elseif($request->type == 'confirmed')
            {
              
                $group->status = "Confirmed Payment";
                //Add code in reward controller
                $userId =  $group->users;
           
                foreach ($userId as $key => $value) {
                   
                    $userIdArray[] = $value->pivot->user_id; 
                    $userByrefer   = User::find($value->pivot->user_id);
                    if($userByrefer->refer_by_user_id && ($userByrefer->refer_flag == 0))
                    {
                        $rewardUser = new Rewards;
                        $rewardUser->to_user_id     = Helper::getUserByUuid($userByrefer->refer_by_user_id)->id;
                        $rewardUser->from_user_id   = $value->pivot->user_id;
                        $rewardUser->amount         = Helper::getAdminAffiliatesRate()->affiliate_percentage     ;
                        
                        if($rewardUser->save())
                        {
                            $userByrefer->refer_flag = 1;
                            $userByrefer->save();
                        }

                    }
                }
            }
            
            $group->save();
            return $group; 
        }
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
}
