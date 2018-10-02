console.log("Exchange Rate Loaded");
function getExchangeRate(type, coin, localcurrency)
{
	axios.get('https://www.bitstamp.net/api/v2/ticker/'+coin+localcurrency).then(response => {
	        	console.log(response.data);
    });
}
function getSelectedUserCurrencyRate()
{
	$('input[name=compare_coins_id]').val($('#exchange_rate_id option:selected').attr('coins_value_id'));
	var bitstamp_access_key = '';
	var localcurrency 		= '';
	var coin 				= '';
	var currency 			= '';
	var _token 				= '';
	var data 				= '';
	var offer_type   		= '';
	var flag 				= 0;
	var exchange_percentage = 0;
	var rate_above_below  	= '';
	var calcul_exchange_rate= 0;
	var crypscrow_percentage= 0;
	var taker_percentage	= 0;
	var crypscrowcharge     = 0;
	var crypscrowchargepercentage = 0;
	offer_type          = $('input[name="offer_type"]').val();
	bitstamp_access_key = $('[name="bitstamp_access_key"]').attr('content');	
	localcurrency 		= $('select[name="exchange_rate_id"] option:selected').attr('used_currency');
	coin     			= $('select[name="local_coins"] option:selected').text();
	currency 			= $('select[name="local_currency"] option:selected').attr('short_name');
	_token   			= $('input[name="_token"]').val();
	rate_above_below    = $('select[name="rate_above_below"] option:selected').val();
	creator_percentage	= parseFloat($('select[name="local_coins"] option:selected').attr('creator_percentage'));
	taker_percentage	= parseFloat($('select[name="local_coins"] option:selected').attr('taker_percentage'));
	crypscrowchargepercentage = creator_percentage + taker_percentage ;
	console.log(creator_percentage);
	console.log(taker_percentage);
	if (typeof bitstamp_access_key === "undefined" || typeof _token === "undefined") 
	{
    	flag = 0;
		swal("Network Error! Try Again Later", "You clicked the button!", "warning");

	}
	else
	{
		flag = 1;
	}
	if (typeof coin === "undefined" && coin !='select') 
	{
    	flag = 0;
		swal("Please Select Coin & Try Again Later", "You clicked the button!", "warning");

	}
	else
	{
		flag = 1;
		coin = coin.toUpperCase();
	}
	if (typeof currency === "undefined") 
	{
    	flag = 0;
		swal("Please Select Local currency & Try Again Later", "You clicked the button!", "warning");

	}
	else
	{
		flag = 1;
		currency = currency.toLowerCase();
	}

	if(typeof offer_type === "undefined")
	{
		flag = 0;
	}
	else
	{
		flag = 1;
	}

	// data 	 			= {localcurrency:localcurrency,coin:coin,currency:currency,_token:_token};
	if(flag =='1' || flag == 1)
	{

		var url = "https://min-api.cryptocompare.com/data/pricemulti?fsyms="+coin+"&tsyms="+localcurrency;	
      	
      	axios.get(url,{
                  transformRequest: [function(data, headers) {
                      
                      delete headers['X-Socket-Id'];
                      delete headers['common']['X-CSRF-TOKEN'];
                      delete headers['common']['X-Requested-With'];
                      return data;
                  }]
        })
		.then(function(response) 
		{
			var currentrate = '';
			
			$.each(response.data,function(ind,val){

				$.each(val,function(i,v){
					currentrate = v;
				});

			});
			
		    if(currentrate!='')
		    {
		    	var from = localcurrency.toUpperCase();
		    	var to   = currency.toUpperCase();
		    	var url  = 'https://data.fixer.io/api/convert?access_key='+bitstamp_access_key+'&from='+from+'&to='+to+'&amount='+currentrate;
		    	
		    	axios.get(url,{
                transformRequest: [function(data, headers) {
                    delete headers['X-Socket-Id'];
                    delete headers['common']['X-CSRF-TOKEN'];
                    delete headers['common']['X-Requested-With'];
                    return data;
	                }]
	            })
		    	.then(function(result){
		    		if(result.data.success)
		    		{
		    			exchange_percentage = parseFloat($('input[name="rate_percentage"]').val());
		    			//exchange_percentage = exchange_percentage - creator_percentage;
		    			if(rate_above_below == 'above')
		    			{

		    				calcul_exchange_rate = ((parseFloat(result.data.result) * (100 + parseFloat(exchange_percentage)))/100).toFixed(2);
		    			}
		    			else
		    			{
		    				calcul_exchange_rate = ((parseFloat(result.data.result) * (100 - parseFloat(exchange_percentage)))/100).toFixed(2);
		    				
		    			}
		    			if(offer_type == 1 || offer_type == '1' )
		    			{
		    				crypscrowcharge      = ((parseFloat(calcul_exchange_rate) * (100 + parseFloat(crypscrowchargepercentage)))/100).toFixed(2);
		    				console.log(crypscrowchargepercentage);

		    				$('#show_exchange_rate').html('Your Exchange Rate as Seller  1('+coin.toUpperCase()+') = '+calcul_exchange_rate+' and Buyer Exchange Rate including crypscrow fees '+crypscrowcharge);
				    		$('input[name="price"]').val(calcul_exchange_rate);
				    		$('input[name="crypscrow_price"]').val(crypscrowcharge); 
				    		
		    			}
		    			if(offer_type == 2 || offer_type == '2' )
		    			{
		    				crypscrowcharge      = ((parseFloat(calcul_exchange_rate) * (100 + parseFloat(crypscrowchargepercentage)))/100).toFixed(2);
		    				$('#show_exchange_rate').html('Your Exchange Rate as Buyer 1('+coin.toUpperCase()+') = '+calcul_exchange_rate+' and Seller Exchange Rate including crypscrow fees '+crypscrowcharge);
				    		$('input[name="price"]').val(calcul_exchange_rate);
				    		$('input[name="crypscrow_price"]').val(crypscrowcharge); 
		    			}
				    			    			
		    		}
		    		else
		    		{
		    			swal("Network Problem!Try Again Later", "You clicked the button!", "error");

		    		}
		    	});
		    }
    	});
	}
	
	

}
function getSelectBoxExchangeRate(token_id, edit = null)
{
	
    axios.get(host+'/selectbox/'+token_id).then(response => {
    	if(response.data)
    	{
        	$('select[name="exchange_rate_id"]').html(response.data);
        	if(edit)
        	{
        		$("select#exchange_rate_id > option").each(function(i,v) {
        			this.selected = ($(this).val() == $('input[name="exchange_rate"]').val() && $(this).attr('coins_value_id')== $('input[name="compare_coins_id"]').val()); 
	            });
	            getSelectedUserCurrencyRate();
        	}
        	
    	}
    	else
    	{
		    swal("Network Problem!Try Again Later", "You clicked the button!", "error");
    	}

    });


}


 function getCurrentRate(coin, localcurrency)
 {

 	 var main_currency  = array('USD','EUR', 'GBP', 'JPY', 'INR');
 	 var html = "";

 	 console.log("function call");
 	 var url = "https://min-api.cryptocompare.com/data/pricemulti?fsyms="+coin+"&tsyms="+localcurrency;	
      axios.get(url,{
                  transformRequest: [function(data, headers) {
                      console.log(headers);
                      delete headers['X-Socket-Id'];
                      delete headers['common']['X-CSRF-TOKEN'];
                      delete headers['common']['X-Requested-With'];
                      return data;
                  }]
              }).then(response => {
      	console.log(response.data);
     	 if(response.data)
     	 {
          	$('select[name="exchange_rate_id"]').html(response.data);
     	 }
     	 else
     	 {
 		     swal("Network Problem!Try Again Later", "You clicked the button!", "error");
     	 }

      });
    
    
 }