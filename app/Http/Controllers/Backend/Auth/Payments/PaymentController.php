<?php

namespace App\Http\Controllers\Backend\Auth\Payments;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Auth\PaymentsRepository;
use App\PaymentMethod;
class PaymentController extends Controller
{
    /**
     * @var PaymentsRepository
     */
    protected $paymentsRepository;


     /**
     * @param PaymentsRepository       $paymentsRepository
     * @param PermissionRepository $permissionRepository
     */
    public function __construct(PaymentsRepository $paymentsRepository)
    {
        $this->paymentsRepository = $paymentsRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('backend.auth.payments.index')->withPayments($this->paymentsRepository
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
        return view('backend.auth.payments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->paymentsRepository->create($request->only('name', 'description'));

        return redirect()->route('admin.auth.payments.index')->withFlashSuccess(__('alerts.backend.payments.created'));
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
        $payments = PaymentMethod::find($id);
        return view('backend.auth.payments.edit')
            ->withPayments($payments);
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
        $payments = PaymentMethod::find($id);
        $this->paymentsRepository->update($payments, $request->only('name', 'description'));

        return redirect()->route('admin.auth.payments.index')->withFlashSuccess(__('alerts.backend.payments.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->paymentsRepository->deleteById($id);

        return redirect()->route('admin.auth.payments.index')->withFlashSuccess(__('alerts.backend.payments.deleted'));
    }
}
