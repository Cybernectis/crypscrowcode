<?php

namespace App\Repositories\Backend\Auth;

use App\AdminSettings;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;


/**
 * Class SettingsRepository.
 */
class SettingsRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return AdminSettings::class;
    }

    /**
     * @param array $data
     *
     * @return AdminSettings
     * @throws GeneralException
     */
    public function create(array $data) : AdminSettings
    {
        // Make sure it doesn't already exist
        if ($this->roleExists($data['name'])) {
            throw new GeneralException('A role already exists with the name '.$data['name']);
        }

        if (! isset($data['permissions']) || ! count($data['permissions'])) {
            $data['permissions'] = [];
        }

        //See if the role must contain a permission as per config
        if (config('access.roles.role_must_contain_permission') && count($data['permissions']) == 0) {
            throw new GeneralException(__('exceptions.backend.access.roles.needs_permission'));
        }

        return DB::transaction(function () use ($data) {
            $role = parent::create(['name' => $data['name']]);

            if ($role) {
                $role->givePermissionTo($data['permissions']);

                event(new RoleCreated($role));

                return $role;
            }

            throw new GeneralException(trans('exceptions.backend.access.roles.create_error'));
        });
    }

    /**
     * @param Role  $role
     * @param array $data
     *
     * @return mixed
     * @throws GeneralException
     */
    public function update(AdminSettings $setting, array $data)
    {
        // if ($setting->isAdmin()) {
        //     throw new GeneralException('You can not edit the administrator role.');
        // }

        // // If the name is changing make sure it doesn't already exist
        // if ($role->name != $data['name']) {
        //     if ($this->roleExists($data['name'])) {
        //         throw new GeneralException('A role already exists with the name '.$data['name']);
        //     }
        // }

        return DB::transaction(function () use ($setting, $data) {
            if ($setting->update([
                'name' => $data['name'],
                'meta_key' => $data['meta_key'],
                'meta_value' => $data['meta_value'],
            ])) {
                
                return $setting;
            }

            throw new GeneralException(trans('exceptions.backend.access.settings.update_error'));
        });
    }

    /**
     * @param $name
     *
     * @return bool
     */
    protected function roleExists($name)
    {
        return $this->model
                ->where('name', $name)
                ->count() > 0;
    }
}
