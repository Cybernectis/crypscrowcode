<?php

namespace App\Http\Controllers\Backend\Auth\Wallet;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Auth\RoleRepository;
use App\Repositories\Backend\Auth\PermissionRepository;
use App\Repositories\Backend\Auth\WalletRepository;
use Helper;
use App\AdminWalletDetail;
class WalletController extends Controller
{

     /**
     * @var RoleRepository
     */
    protected $roleRepository;
    protected $walletRepository;
    /**
     * @var PermissionRepository
     */
    protected $permissionRepository;

    /**
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     */
    public function __construct(RoleRepository $roleRepository, PermissionRepository $permissionRepository, WalletRepository $walletRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->walletRepository = $walletRepository;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.auth.wallet.index')->withWallets($this->walletRepository
                ->orderBy('id', 'asc')
                ->paginate(25));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allCoinIds = AdminWalletDetail::pluck("local_coins_id")->toArray();
      
        return view('backend.auth.wallet.create', compact("allCoinIds"))
            ->withPermissions($this->permissionRepository->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $apiContext = Helper::blockCypherConfig(Helper::getLocalCoinName($request->local_coins, "short_name")); 
        $addressClient = new \BlockCypher\Client\AddressClient($apiContext);

        try {
            
            $addressKeyChain = $addressClient->generateAddress();

            if (!empty($addressKeyChain))
            {
                $response = $addressKeyChain;
                $wallet = new AdminWalletDetail;
                $wallet->local_coins_id     =   $request->local_coins;
                $wallet->private_key   =   $response->private;
                $wallet->public_key    =   $response->public;
                $wallet->address       =   $response->address;
                $wallet->save();
                echo $wallet->address;
            }
        } catch (Exception $ex) {
            ResultPrinter::printError("Create BlockCypher Test Address", "AddressKeyChain", null, $request, $ex);
            exit(1);
        }

        return redirect()->route('admin.auth.wallet.index')->withFlashSuccess(__('alerts.backend.wallet.created'));
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


    public function genrateaddress(Request $request)
    {
        $apiContext = Helper::blockCypherConfig();
        $addressClient = new \BlockCypher\Client\AddressClient($apiContext);

        try {
            
            $addressKeyChain = $addressClient->generateAddress();

            if (!empty($addressKeyChain))
            {
                $response = $addressKeyChain;
                $wallet = new AdminWalletDetail;
                $wallet->local_coins_id     =   $request->local_coins;
                $wallet->private_key   =   $response->private;
                $wallet->public_key    =   $response->public;
                $wallet->address       =   $response->address;
                $wallet->save();
                echo $wallet->address;
            }
        } catch (Exception $ex) {
            ResultPrinter::printError("Create BlockCypher Test Address", "AddressKeyChain", null, $request, $ex);
            exit(1);
        }
    }
}
