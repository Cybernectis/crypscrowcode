<?php

namespace App\Http\Controllers\backend\Auth\Localcoins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Auth\LocalcoinsRespository;
use App\Localcoin;
use App\Http\Requests\Backend\Auth\Localcoins\LocalcoinRequest;
class LocalcoinsController extends Controller
{
    /**
     * @var settingRepository
     */
    protected $localcoinRepository;


     /**
     * @param LocalcoinsRespository       $localcoinRepository
     * @param PermissionRepository $permissionRepository
     */
    public function __construct(LocalcoinsRespository $localcoinRepository)
    {
        $this->localcoinRepository = $localcoinRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('backend.auth.localcoins.index')->withLocalCoins($this->localcoinRepository
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
        return view('backend.auth.localcoins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->localcoinRepository->create($request->only('name', 'short_name', "creator_percentage", "taker_percentage"
            , "unit_name", "unit_value"));

        return redirect()->route('admin.auth.localcoins.index')->withFlashSuccess(__('alerts.backend.localcoins.created'));
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
        // if ($role->isAdmin()) {
        //     return redirect()->route('admin.auth.role.index')->withFlashDanger('You can not edit the administrator role.');
        // }
        $localcoins = Localcoin::find($id);
        return view('backend.auth.localcoins.edit')
            ->withLocalcoins($localcoins);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LocalcoinRequest $request, $id)
    {
        $localcoins = Localcoin::find($id);
        $this->localcoinRepository->update($localcoins, $request->only('name', 'short_name', "creator_percentage", "taker_percentage"
            , "unit_name", "unit_value"));

        return redirect()->route('admin.auth.localcoins.index')->withFlashSuccess(__('alerts.backend.localcoins.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->localcoinRepository->deleteById($id);

        return redirect()->route('admin.auth.localcoins.index')->withFlashSuccess(__('alerts.backend.localcoins.deleted'));
    }
}
