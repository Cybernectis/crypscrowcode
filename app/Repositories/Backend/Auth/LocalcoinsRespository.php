<?php
namespace App\Repositories\Backend\Auth;

use App\LocalCoin;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;


/**
 * Class LocalcoinsRespository.
 */
class LocalcoinsRespository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return LocalCoin::class;
    }

    /**
     * @param array $data
     *
     * @return LocalCoin
     * @throws GeneralException
     */
    public function create(array $data) : LocalCoin
    {
        // Make sure it doesn't already exist
        // if ($this->roleExists($data['name'])) {
        //     throw new GeneralException('A role already exists with the name '.$data['name']);
        // }

        // if (! isset($data['permissions']) || ! count($data['permissions'])) {
        //     $data['permissions'] = [];
        // }

        // //See if the role must contain a permission as per config
        // if (config('access.roles.role_must_contain_permission') && count($data['permissions']) == 0) {
        //     throw new GeneralException(__('exceptions.backend.access.roles.needs_permission'));
        // }

        return DB::transaction(function () use ($data) {
            $localcoin = parent::create(['name'                      => $data['name'],
                'short_name'                => $data['short_name'],
                'creator_percentage'        => $data['creator_percentage'],
                'taker_percentage'                => $data['taker_percentage'],
                'unit_name'                => $data['unit_name'],
                'unit_value'                => $data['unit_value']]);
            if ($localcoin) {
                
                return $localcoin;
            }
            

            throw new GeneralException(trans('exceptions.backend.access.localcoins.create_error'));
        });
    }

    /**
     * @param Role  $role
     * @param array $data
     *
     * @return mixed
     * @throws GeneralException
     */
    public function update(LocalCoin $localcoin, array $data)
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

        return DB::transaction(function () use ($localcoin, $data) {
            if ($localcoin->update([
                'name'                      => $data['name'],
                'short_name'                => $data['short_name'],
                'creator_percentage'        => $data['creator_percentage'],
                'taker_percentage'                => $data['taker_percentage'],
                'unit_name'                => $data['unit_name'],
                'unit_value'                => $data['unit_value'],
            ])) {
                
                return $localcoin;
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
