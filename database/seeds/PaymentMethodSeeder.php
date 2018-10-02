<?php

use Illuminate\Database\Seeder;
use App\PaymentMethod;
class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$paymentsArray = array(
    						"Cash(in person)"	=> "You’ll organise a time and meeting place with the buyer to exchange cash in person.",
							"Bank Transfer" 	=> "The buyer will transfer money from their account to your bank account.",
							"Cash Deposit" => "The buyer will deposit cash to your bank account in-person.",

							"PayPal" => "The buyer will send you money online via PayPal.
										<strong>Be careful</strong>
										: PayPal is a high-risk payment method, as it is susceptible to chargeback fraud.",

							"International wire" =>"The buyer will transfer you money via an international bank wire.",
							"Other" => "Mention your custom payment method in the offer headline.",
							"Alipay"=>"The buyer will send you money online via Alipay.",
							"WeChat Pay"=>"The buyer will send you money online via WeChat Pay.");
    	foreach ($paymentsArray as $key => $value) {
    		$type = new PaymentMethod;
	        $type->name = $key;
	        $type->description = $value;
	        $type->save();
    	}
        
    }
}
