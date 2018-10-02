<?php 
namespace App\Helpers;
use BlockCypher\Auth\SimpleTokenCredential;
use BlockCypher\Rest\ApiContext;
use BlockCypher\Api\Address;
use BlockCypher\Client\AddressClient;
use App\Trades;
use App\LocalCoin;
use App\Models\Auth\User;
use App\Page;
use App\AdminAffiliates;
use App\Rewards;
class Helpers
{
	public static function get_times( $default = '19:00', $interval = '+15 minutes' ) {

        $output = '<option value="">Select</option>';

        $current = strtotime( '00:00' );
        $end = strtotime( '23:59' );

        while( $current <= $end ) {
            $time = date( 'H:i', $current );
            // $sel = ( $time == $default ) ? ' selected' : '';

            $output .= "<option value=\"{$time}\">" . date( 'h.i A', $current ) .'</option>';
            $current = strtotime( $interval, $current );
        }

        echo $output;
    }


    public static function get_time_zone()
    {
    	$output = "";
    	$output = '<option value="">Select</option>';

    	for ($i=-12; $i <= 14 ; $i++) { 
    		
    		if($i >= 0){
    			$output .= "<option value=\"GMT+{$i}\">" . "GMT+".$i .'</option>';
    		}
    		else{
    			$output .= "<option value=\"GMT{$i}\">" . "GMT".$i .'</option>';
    		}
    	}
    	echo $output;
    }


    public static function getDisplayTradeLimit($id)
    {
        $trade = Trades::find($id);

        if($trade)
        {
            
            if ($trade->maximum_limit != 0 && $trade->minimum_limit != 0) {
               echo "<b>".$trade->userLocalCurrency()->value('short_name')."</b> ".$trade->minimum_limit." - "."<b>".$trade->userLocalCurrency()->value('short_name')."</b> ".$trade->maximum_limit;
            }elseif($trade->minimum_limit != 0 && $trade->maximum_limit == 0)
            {
                echo "from "."<b>".$trade->userLocalCurrency()->value('short_name')."</b> ".$trade->minimum_limit;
            }elseif($trade->maximum_limit == 0)
            {
                echo "no limits";
            }elseif ($trade->maximum_limit != 0 && $trade->minimum_limit != 0 || $trade->minimum_limit == 0) {
               echo "upto "."<b>".$trade->userLocalCurrency()->value('short_name')."</b> ".$trade->maximum_limit;
            }
        }
    }

    public static function blockCypherConfig($coinshortname)
    {
        $token = env('BLOCK_CYPHER_TOKEN');
        $coinshortname = strtolower($coinshortname);
        // SDK config
        $config = array(
            'mode' => 'sandbox',
            'log.LogEnabled' => true,
            'log.FileName' => 'BlockCypher.log',
            'log.LogLevel' => 'DEBUG', // PLEASE USE 'INFO' LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
            'validation.level' => 'log',
        );

        if(env('BLOCK_CYPHER_TYPE') == 'test')
        {
            $coinshortname = "bcy";
        }

        $apiContext = ApiContext::create(
            env('BLOCK_CYPHER_TYPE'), $coinshortname, 'v1',
            new SimpleTokenCredential(env('BLOCK_CYPHER_TOKEN')),
            $config
        );
        
        
        return $apiContext;
    }

    public static function getLocalCoinName($id, $nameType)
    {
        $coinDetails = LocalCoin::find($id);
        if (!empty($coinDetails)) 
        {
           if ($nameType == "short_name") {
              return $coinDetails['short_name'];
           }
           return $coinDetails['name'];
        }
    }

    public static function getUsername($id)
    {
        $user = User::find($id);
        if (!empty($user)) {
            return $user['username'];
        }
    }

    public static function getWalletBalance($address, $coinshortname = "bcy")
    {
        $coinshortname = strtolower($coinshortname);
        $apiContext = SELF::blockCypherConfig($coinshortname);
        try {
            $addressBalance = \BlockCypher\Api\AddressBalance::get($address, array(), $apiContext);
        } catch (Exception $ex) {
            return "Error";
            exit(1);
        }
        return $addressBalance->balance;
    }

    public static function getJavascriptApi()
    {
        
        
        try{
            $url = "http://www.geoplugin.net/javascript.gp?ip=".$_SERVER['REMOTE_ADDR']."";
           
            $data = file_get_contents($url);
            echo $data;
        }
        catch(\Exception $e){
            echo "error";
        }
        
    }


     public static function pages()
    {
        return $pages = Page::all();
    }

    public static function pageByName($name)
    {
      return Page::where('slug', $name)->first();
    }

    public static function getAdminAffiliatesRate()
    {
        $returnData = AdminAffiliates::first(); 
        return $returnData;
    }


    public static function getUserRewardsAmount($user_id)
    {
        $rewardsAmount = Rewards::where("to_user_id", $user_id)->where("paid_status", 0)->sum("amount");
        return $rewardsAmount;
    }


    public static function getUserByUuid($uuid)
    {
        $user = User::where("uuid", $uuid)->first();
        if (!empty($user)) {
            return $user;
        }
    }
}	