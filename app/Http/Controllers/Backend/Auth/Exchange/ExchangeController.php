<?php
namespace App\Http\Controllers\backend\Auth\Exchange;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Auth\ExchangeRepository;
use App\ExchangeRate;
use App\Http\Requests\Backend\Auth\Exchange\ExchangeRequest;
class ExchangeController extends Controller
{
    /**
     * @var ExchangeRepository
     */
    protected $exchangeRepository;


     /**
     * @param SettingsRepository       $exchangeRepository
     * @param PermissionRepository $permissionRepository
     */
    public function __construct(ExchangeRepository $exchangeRepository)
    {
        $this->exchangeRepository = $exchangeRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('backend.auth.exchange.index')->withExchangeRates($this->exchangeRepository
                ->orderBy('id', 'asc')
                ->paginate(25));;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('backend.auth.exchange.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $exchange = new ExchangeRate;
        $exchange->api_name = $request->api_name;
        $exchange->token_code = $request->token_code;
        $exchange->currency = $request->currency;
        $exchange->save();
        return redirect()->route('admin.auth.exchangerate.index')->withFlashSuccess(__('alerts.backend.exchange.created'));
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
    public function edit(ExchangeRate $exchange, $id)
    {
        
    	$exchange = ExchangeRate::find($id);
        return view('backend.auth.exchange.edit')
            ->withExchange($exchange);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExchangeRequest $request, $id)
    {
    	
    	$exchange = ExchangeRate::find($id);
        $this->exchangeRepository->update($exchange, $request->only('api_name', 'token_code', "currency"));

        return redirect()->route('admin.auth.exchangerate.index')->withFlashSuccess(__('alerts.backend.exchange.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $this->exchangeRepository->deleteById($id);

        return redirect()->route('admin.auth.exchangerate.index')->withFlashSuccess(__('alerts.backend.exchange.deleted'));
    }
}
