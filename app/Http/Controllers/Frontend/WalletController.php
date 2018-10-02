<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\LocalCoin;
use App\UserWallet;
use App\Transaction;
use Helper;


class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $user_id = auth()->user()->id;

        $result  = UserWallet::where('users_id','=',$user_id)->with('getlocalcoin')->get();
        // echo "<pre>";print_r($result[0]->getlocalcoin[0]->short_name);die;
        
        return view('frontends.wallet.index',compact('result'));
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
    public function showFundTransfer()
    {
        $user_id = auth()->user()->id;
        $transaction  = Transaction::where('users_id','=',$user_id)->get();
        
        return view('frontends.wallet.fundtransfer',compact('transaction'));
    }
    public function getWalletOfSelectedCoin(Request $request)
    {
        $user_id    = $request->user_id;
        $coin_id    = $request->coin_id;
        if($request->has('is_admin'))
        {
            $result     = \App\AdminWalletDetail::where('local_coins_id','=',$coin_id)->first()->toJson();
        }
        else
        {
            $result     = UserWallet::where('users_id','=',$user_id)->where('local_coins_id','=',$coin_id)->first()->toJson();
        }
        
        echo $result;
    }
    public function storeTransaction(Request $request)
    {
        
        $insertobj = new Transaction;
        $insertobj->to_address  = $request->sender_address;
        $insertobj->from_address = $request->reciever_address;
        $insertobj->users_id = $request->user_id;
        $insertobj->local_coins_id = $request->coin_id;
        $insertobj->amount = $request->amount;
        $insertobj->network_fees = $request->network_fees;
        $insertobj->is_admin_wallet = 0;
        $insertobj->hash = $request->hash;
        $insertobj->save();
        return "success";

    }
    
}
