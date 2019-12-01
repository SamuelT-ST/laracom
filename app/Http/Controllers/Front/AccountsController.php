<?php

namespace App\Http\Controllers\Front;

use App\Shop\Couriers\Repositories\Interfaces\CourierRepositoryInterface;
use App\Shop\Customers\Repositories\CustomerRepository;
use App\Shop\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Shop\Orders\Order;
use App\Shop\Orders\Transformers\OrderTransformable;
use App\Shop\OrderStatuses\OrderStatus;
use Illuminate\Support\Facades\Auth;

class AccountsController extends Controller
{
    use OrderTransformable;

    /**
     * @var CustomerRepositoryInterface
     */
    private $customerRepo;

    /**
     * @var CourierRepositoryInterface
     */
    private $courierRepo;

    /**
     * AccountsController constructor.
     *
     * @param CourierRepositoryInterface $courierRepository
     * @param CustomerRepositoryInterface $customerRepository
     */
    public function __construct(
        CourierRepositoryInterface $courierRepository,
        CustomerRepositoryInterface $customerRepository
    ) {
        $this->customerRepo = $customerRepository;
        $this->courierRepo = $courierRepository;
    }

    public function index()
    {

//        TODO dorobit v dalsej faze editaciu adries

//        $customer = $this->customerRepo->findCustomerById(auth()->user()->id);

//        $customerRepo = new CustomerRepository($customer);
//        $orders = $customerRepo->findOrders(['*'], 'created_at');

//        $orders->transform(function (Order $order) {
//            return $this->transformOrder($order);
//        });

//        $addresses = $customerRepo->findAddresses();

        if (!Auth::user()){
            abort(404);
        }

        $statuses = OrderStatus::with('orders')->whereHas('orders', function ($q){
            $q->where('customer_id', auth()->user()->id);
        })->get();

//        dd($statuses);

        return view('front.account.orders', [
//            'customer' => $customer,
//            'orders' => $this->customerRepo->paginateArrayResults($orders->toArray(), 15),
//            'addresses' => $addresses,
            'statuses' => OrderStatus::with('orders')->whereHas('orders', function ($q){
                $q->where('customer_id', auth()->user()->id);
            })->get(),
        ]);
    }
}
