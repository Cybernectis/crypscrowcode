<?php

namespace App\Http\Controllers\Frontend\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Trades;
use Auth;
use Illuminate\Support\Facades\Crypt;
use App\ExchangeRate;
use App\LocalCoin;
use App\Wallet;
use App\AdminWalletDetail;
use App\Transaction;
use Helper;
use BlockCypher\Api\Address;

use App\UserWallet;
use App\Group;
use App\CompareCoins;

class TradesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trades = Trades::where("user_id", Auth::id())->latest()->get();
        return view("frontends.myoffers.index", compact('trades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         
        return view("frontends.myoffers.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $trade = new Trades;
        $trade->user_id             = Auth::id();
        $trade->offer_type_id       = $request->offer_type;
        $trade->payment_method_id   = $request->payment_method;
        $trade->local_currency_id   = $request->local_currency;
        $trade->local_coins_id      = $request->local_coins;
        $trade->city                = $request->city;
        $trade->minimum_limit       = $request->minimum_limit;
        $trade->maximum_limit       = $request->maximum_limit;
        $trade->headline            = $request->headline;
        $trade->terms_of_trades     = $request->terms_of_trades;
        $trade->standards_hours     = $request->standards_hours;
        $trade->from_hours          = $request->from_hours;
        $trade->to_hours            = $request->to_hours;
        $trade->timezone            = $request->timezone;
        $trade->rate_percentage     = $request->rate_percentage;
        $trade->exchange_rate_id    = $request->exchange_rate_id;
        $trade->rate_above_below    = $request->rate_above_below;
        $trade->price               = $request->price;
        $trade->crypscrow_price     = $request->crypscrow_price;
        $trade->compare_coins_id     = $request->compare_coins_id;

        $trade->save();

        return redirect()->route('frontend.user.my-offers')->withFlashSuccess(__('strings.frontend.user.offer_created'));
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
        $id = base64_decode($id);
        $trades = Trades::find($id);
        return view("frontends.myoffers.edit", compact("trades"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $trade = Trades::find($id);
        $trade->offer_type_id = $request->offer_type;
        $trade->payment_method_id = $request->payment_method;
        $trade->local_currency_id = $request->local_currency;
        $trade->local_coins_id       = $request->local_coins;
        $trade->city = $request->city;
        $trade->minimum_limit = $request->minimum_limit;
        $trade->maximum_limit = $request->maximum_limit;
        $trade->headline = $request->headline;
        $trade->terms_of_trades = $request->terms_of_trades;
        $trade->standards_hours = $request->standards_hours;
        $trade->from_hours = $request->from_hours;
        $trade->to_hours = $request->to_hours;
        $trade->timezone = $request->timezone;
        $trade->rate_percentage     = $request->rate_percentage;
        $trade->exchange_rate_id    = $request->exchange_rate_id;
        $trade->rate_above_below    = $request->rate_above_below;
        $trade->price               = $request->price;
        $trade->compare_coins_id     = $request->compare_coins_id;
        $trade->save();

        return redirect()->route('frontend.user.my-offers')->withFlashSuccess(__('strings.frontend.user.offer_updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trade = Trades::find($id);
        $trade->delete();
        echo json_encode("string");
    }


    public function updateTradeStatus(Request $request)
    {
        $id = $request->id;
        $trade = Trades::find($id);
        $value = $trade;
        if($trade)
        {
            $trade->is_paused = $request->is_paused;
            $trade->save();
            return \Response::view('frontends.parts.myoffers.singlerow', compact("value"));
        }

    }


    public function tradeindex()
    {
        
        $trades = array();
        $trades['activeTrades'] = [];
        $trades['pastTrades'] =[];
        $groups = auth()->user()->groups;
            if(!empty($groups))
            {
                $groups = $groups->load('tradeData');
                foreach ($groups->sortByDesc('created_at') as $key => $value) {
                    if($value->status == "Cancelled" || $value->status == "Confirmed Payment")
                    {
                        
                        $trades['pastTrades'][] = $value;
                    }
                    elseif($value->status == "Waiting for escrow" || $value->status == "Payment pending")
                    {
                        $trades['activeTrades'][] = $value;
                    }
                  
                }
            }
        return view("frontends.mytrades.index", compact("trades"));
    }


    public function getExchangeRateSelectBox($token_id)
    {
        $coin_name      = LocalCoin::find($token_id)->short_name;
        // $exchange_rates = ExchangeRate::all();
        $select_options = '<option value="">Select</option>';
        $main_currency  = CompareCoins::all();

        // foreach ($exchange_rates as $key => $value) {
        //     foreach ($main_currency as $keys => $values) {
        //         $select_options .='<option value="'.$value->id.'" used_currency="'.$values->coin_short_name.'" coins_value_id="'.$values->id.'" >'.$coin_name."/".$values->coin_short_name.'</option>';
        //     }
        // }
        foreach ($main_currency as $keys => $values) {
            $select_options .='<option value="'.$token_id.'" used_currency="'.$values->coin_short_name.'" coins_value_id="'.$values->id.'" >'.$coin_name."/".$values->coin_short_name.'</option>';
        }
        echo json_encode($select_options);
    }


    public function ExchangeRate(Request $request)
    {
        if(!empty($request->coin) && 
            !empty($request->currency) &&
            !empty($request->localcurrency)
        )
        {
            $data           = '';
            $coin           = $request->coin;
            $currency       = $request->currency;
            $localcurrency  = $request->localcurrency;
            $data           = file_get_contents("https://www.bitstamp.net/api/v2/ticker/".$coin.$localcurrency);
            
            if(!empty($data))
            {
                $result = json_decode($data);
                $amount = $result->last;
                // set API Endpoint, access key, required parameters
                $endpoint = 'convert';
                $access_key = '9169d92dbd600abca2469ee930b604c8';

                $from = strtoupper($localcurrency);
                $to = strtoupper($currency);
                // $amount = 10;

                // initialize CURL:
                $ch = curl_init('https://data.fixer.io/api/'.$endpoint.'?access_key='.$access_key.'&from='.$from.'&to='.$to.'&amount='.$amount.'');   
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                // get the JSON data:
                $json = curl_exec($ch);
                curl_close($ch);

                // Decode JSON response:
                $conversionResult = json_decode($json, true);

                // access the conversion result
                echo $conversionResult['result'];
            }
            
        }

    }

    public function CalculateCoin($id,$investamount)
    {

        $trade_id       =   $id;
        $investamount   =   (float)$investamount;

        if(!empty($investamount) && !empty($trade_id) && $investamount > 0)
        {

           
            $trades         = Trades::find($trade_id);

            $offer_rate     = (float)$trades->crypscrow_price;


            $get_unit_value = 1;

            $unit_vale_price= bcdiv($offer_rate,$get_unit_value,18);

            if($unit_vale_price > 0)
            {

                $quantity       = bcdiv($investamount,$unit_vale_price,18);
            }
            else
            {
                $quantity = 0;
            }


            return $quantity;

        }
    }

    public function getNetworkFeesData($token_id)
    {
        
        if(!empty($token_id))
        {
            $adminwalletdetail = AdminWalletDetail::where('local_coins_id','=',$token_id)->first();
            echo json_encode($adminwalletdetail);

        }
        else
        {
            $adminwalletdetail = '';
            echo json_encode($adminwalletdetail);
        }
        
       

        
    }
//This function is to generatrate tranction from backend
    public function fundescrow(Request $request)
    {
        
//         
        $tx = new \BlockCypher\Api\TX();

        $input = \BlockCypher\Builder\TXInputBuilder::aTXInput()
            ->addAddress("C1PPdvWrikU3iVQueSLavAddjHQUZnoZzp")
            ->build();

        $output = \BlockCypher\Builder\TXOutputBuilder::aTXOutput()
            ->addAddress("C3fkXMPuSdXjxaph6hgZBWiGPyV7y3hPKW")
            ->withValue(1000)
            ->build();

        $tx = \BlockCypher\Builder\TXBuilder::aTX()
            ->addTXInput($input)
            ->addTXOutput($output)
            ->build();

        // For Sample Purposes Only.
        $request = clone $tx;
        $apiContexts = Helper::blockCypherConfig('bcy');
        
        $txClient = new \BlockCypher\Client\TXClient($apiContexts);

        try {
            // ### Create New TX
            $txSkeleton = $txClient->create($tx);
        } catch (Exception $ex) {
            //ResultPrinter::printError("Created TX Doge", "TXSkeleton", null, $request, $ex);
            exit(1);
        }

       // ResultPrinter::printResult("Created TX Doge", "TXSkeleton", $txSkeleton->getTx()->getHash(), $request, $txSkeleton);
        $privateKeys = array(
    "13423bbe70aedab19243fbf40705f6c9a0cd6e5b56a434f99d8eff3885c7c674" // Address: C5vqMGme4FThKnCY44gx1PLgWr86uxRbDm
);

// ### Sign the TX
try {
    $txClient->sign($txSkeleton, $privateKeys);
} catch (Exception $ex) {
   // ResultPrinter::printError("Sign Transaction DOGE", "TXSkeleton", null, $request, $ex);
    exit(1);
}
// Source address: <a href="https://live.blockcypher.com/bcy/address/C5vqMGme4FThKnCY44gx1PLgWr86uxRbDm/">C5vqMGme4FThKnCY44gx1PLgWr86uxRbDm</a>
// Destination address: <a href="https://live.blockcypher.com/bcy/address/C4MYFr4EAdqEeUKxTnPUF3d3whWcPMz1Fi/">C4MYFr4EAdqEeUKxTnPUF3d3whWcPMz1Fi</a>

// For sample purposes only.
$request = clone $txSkeleton;

try {
    // ### Send TX to the network
    $txSkeleton = $txClient->send($txSkeleton);
} catch (Exception $ex) {
   // ResultPrinter::printError("Send Transaction DOGE", "TXSkeleton", null, $request, $ex);
    exit(1);
}

//ResultPrinter::printResult("Send Transaction DOGE", "TXSkeleton", $txSkeleton->getTx()->getHash(), $request, $txSkeleton);

return $createdWallet;
        return $txSkeleton;
        
    }


   public function getTradeKeysDetails(Request $request)
   {
        //$trade = Trades::find($request->trade_id);
        $group         = Group::find($request->trade_id);
        $error = 0;
        $data = array();
        $adminwalletdetail = '';
        
        if(!empty($group))
        {
            $group          =   $group->load("tradeData");
            $userId         =   $group->users;            
            // echo "<pre>";print_r($userId);die;
            $userWallet     =   "";
            $tradepartner   =   '';
            foreach ($userId as $key => $value) 
            {
                 // return $group->tradeData->user_id.auth()->user()->id.$value->pivot->user_id;
                
                if(($value->pivot->user_id != auth()->user()->id))
                {
                    $tradepartner = $value->pivot->user_id;
                    
                    
                }

            }
                
            if(!empty($tradepartner))
            {

                $data['userWallet'] = UserWallet::where("local_coins_id", $group->tradeData->local_coins_id)
                       							->where("users_id", $tradepartner)
                       							->first();
            }
           
        }
        
        
        
        if(!empty($group->tradeData->local_coins_id))
        {

            $data['adminwalletdetail']  = AdminWalletDetail::where('local_coins_id','=',$group->tradeData->local_coins_id)->first();
            $coin_quantity      = self::CalculateCoin($group->tradeData->id,$group->amount);
            $data['coin_quantity_unit'] = bcmul($coin_quantity , LocalCoin::find($group->tradeData->local_coins_id)->unit_value);

        }
        return json_encode($data);
   }

   public function storeEscrowTransaction(Request $request)
    {
        
        $insertobj = new Transaction;
        $insertobj->to_address  = $request->sender_address;
        $insertobj->from_address = $request->reciever_address;
        $insertobj->users_id = $request->user_id;
        $insertobj->local_coins_id = $request->coin_id;
        $insertobj->amount = $request->amount;
        $insertobj->network_fees = $request->network_fees;
        $insertobj->is_admin_wallet = 1;
        $insertobj->hash = $request->hash;
        $insertobj->save();
        return "success";

    }
}