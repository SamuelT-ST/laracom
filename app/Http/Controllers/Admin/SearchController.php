<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CompanyRepository;
use App\Repositories\PersonCompanyRepository;
use App\Repositories\PersonRepository;
use App\Shop\Customers\Repositories\CustomerRepository;
use App\Shop\Products\Repositories\ProductRepository;

class SearchController extends Controller
{
    /**
     * @param int $from
     * @param string $query
     * @return mixed
     */
    public function searchProductQuery(?int $from = null, string $query = null) : ?array
    {
        return app(ProductRepository::class)->getProductsOnAutocomplete($from, $query);
    }

    /**
     * @param int $from
     * @param string $query
     * @return mixed
     */
    public function searchCustomerQuery(?int $from = null, string $query = null) : ?array
    {
        return app(CustomerRepository::class)->getCustomersOnAutocomplete($from, $query);
    }

}
