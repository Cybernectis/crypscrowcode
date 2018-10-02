<?php

namespace App\Http\Controllers\Backend\Auth\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Auth\SettingsRepository;
use App\AdminSettings;
use App\Http\Requests\Backend\Auth\Settings\UpdateSettingRequest;

class SettingsController extends Controller
{
    /**
     * @var settingRepository
     */
    protected $settingRepository;


     /**
     * @param SettingsRepository       $settingRepository
     * @param PermissionRepository $permissionRepository
     */
    public function __construct(SettingsRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('backend.auth.settings.index')->withSettings($this->settingRepository
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
    public function edit(AdminSettings $setting)
    {
        // if ($role->isAdmin()) {
        //     return redirect()->route('admin.auth.role.index')->withFlashDanger('You can not edit the administrator role.');
        // }

        return view('backend.auth.settings.edit')
            ->withSetting($setting);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminSettings $setting, UpdateSettingRequest $request)
    {
        $this->settingRepository->update($setting, $request->only('name', 'meta_key', "meta_value"));

        return redirect()->route('admin.auth.settings.index')->withFlashSuccess(__('alerts.backend.settings.updated'));
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
