<?php
namespace App\Repositories\Backend\Auth;

use App\PaymentMethod;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;


/**
 * Class PaymentsRepository.
 */
class PaymentsRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return PaymentMethod::class;
    }

    /**
     * @param array $data
     *
     * @return PaymentMethod
     * @throws GeneralException
     */
    public function create(array $data) : PaymentMethod
    {
       

        return DB::transaction(function () use ($data) {
            $payment = parent::create(['name'                      => $data['name'],
                'description'                => $data['description'],
               ]);
            if ($payment) {
                
                return $payment;
            }
            

            throw new GeneralException(trans('exceptions.backend.access.payments.create_error'));
        });
    }

    /**
     * @param Role  $role
     * @param array $data
     *
     * @return mixed
     * @throws GeneralException
     */
    public function update(PaymentMethod $payments, array $data)
    {
       

        return DB::transaction(function () use ($payments, $data) {
            if ($payments->update([
                'name'                      => $data['name'],
                'description'                => $data['description'],
            ])) {
                
                return $payments;
            }

            throw new GeneralException(trans('exceptions.backend.access.payments.update_error'));
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
