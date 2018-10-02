<?php

namespace App\Http\Controllers\Backend\Auth\Affiliates;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AdminAffiliates;
class AffiliatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $affiliates = AdminAffiliates::all();
        return view("backend.auth.affiliates.index", compact("affiliates"));
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
        $affiliate = AdminAffiliates::find($id);
        return view('backend.auth.affiliates.edit')
            ->withAffiliate($affiliate);
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
        $affiliate  = AdminAffiliates::find($id);
        if(!empty($affiliate))
        {
            $affiliate->affiliate_percentage = $request->affiliate_percentage;
            $affiliate->amount_symbol = $request->amount_symbol;
            $affiliate->minimum_amount = $request->minimum_amount;
            $affiliate->save();
            return redirect()->route('admin.auth.affiliates.index')->withFlashSuccess(__('alerts.backend.affiliates.updated'));

        }
        throw new GeneralException(trans('exceptions.backend.access.settings.update_error'));
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
