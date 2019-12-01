@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.order.actions.index'))

@section('body')

    <order-listing
        :data="{{ $data->toJson() }}"
        :url="'{{ url('admin/orders') }}'"
        inline-template>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> {{ trans('admin.order.actions.index') }}
                        <a class="btn btn-primary btn-spinner btn-sm pull-right m-b-0" href="{{ url('admin/orders/create') }}" role="button"><i class="fa fa-plus"></i>&nbsp; {{ trans('admin.order.actions.create') }}</a>
                    </div>
                    <div class="card-body" v-cloak>
                        <form @submit.prevent="">
                            <div class="row justify-content-md-between">
                                <div class="col col-lg-7 col-xl-5 form-group">
                                    <div class="input-group">
                                        <input class="form-control" placeholder="{{ trans('brackets/admin-ui::admin.placeholder.search') }}" v-model="search" @keyup.enter="filter('search', $event.target.value)" />
                                        <span class="input-group-append">
                                            <button type="button" class="btn btn-primary" @click="filter('search', search)"><i class="fa fa-search"></i>&nbsp; {{ trans('brackets/admin-ui::admin.btn.search') }}</button>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-sm-auto form-group ">
                                    <select class="form-control" v-model="pagination.state.per_page">
                                        
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>

                            </div>
                        </form>

                        <table class="table table-hover table-listing">
                            <thead>
                                <tr>
                                    <th is='sortable' :column="'id'">{{ trans('admin.order.columns.id') }}</th>
                                    <th is='sortable' :column="'reference'">{{ trans('admin.order.columns.reference') }}</th>
                                    <th is='sortable' :column="'customer'">{{ trans('admin.order.columns.customer_id') }}</th>
                                    <th is='sortable' :column="'order_status'">{{ trans('admin.order.columns.order_status_id') }}</th>
                                    <th is='sortable' :column="'payment'">{{ trans('admin.order.columns.payment') }}</th>
                                    <th is='sortable' :column="'total_products'">{{ trans('admin.order.columns.total_products') }}</th>
                                    <th is='sortable' :column="'tax'">{{ trans('admin.order.columns.tax') }}</th>
                                    <th is='sortable' :column="'total'">{{ trans('admin.order.columns.total') }}</th>
                                    <th is='sortable' :column="'total_paid'">{{ trans('admin.order.columns.total_paid') }}</th>
                                    <th is='sortable' :column="'courier'">{{ trans('admin.order.columns.courier') }}</th>
                                    <th is='sortable' :column="'total_shipping'">{{ trans('admin.order.columns.total_shipping') }}</th>
                                    
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in collection">
                                    <td>@{{ item.id }}</td>
                                    <td>@{{ item.reference }}</td>
                                    <td>@{{ item.customer_name }}</td>
                                    <td><div class="badge badge-primary" :style="'background-color: '+item.order_status.color"> @{{ item.order_status.name }}</div></td>
                                    <td>@{{ item.payment.title }}</td>
                                    <td>@{{ item.total_products }}</td>
                                    <td>@{{ item.tax }}</td>
                                    <td>@{{ item.total }}</td>
                                    <td>@{{ item.total_paid }}</td>
                                    <td>@{{ item.courier.name }}</td>
                                    <td>@{{ item.total_shipping }}</td>
                                    
                                    <td>
                                        <div class="row no-gutters">
                                            <div class="col-auto">
                                                <a class="btn btn-sm btn-spinner btn-info" :href="item.resource_url + '/edit'" title="{{ trans('brackets/admin-ui::admin.btn.edit') }}" role="button"><i class="fa fa-edit"></i></a>
                                            </div>
                                            <form class="col" @submit.prevent="deleteItem(item.resource_url)">
                                                <button type="submit" class="btn btn-sm btn-danger" title="{{ trans('brackets/admin-ui::admin.btn.delete') }}"><i class="fa fa-trash-o"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="row" v-if="pagination.state.total > 0">
                            <div class="col-sm">
                                <span class="pagination-caption">{{ trans('brackets/admin-ui::admin.pagination.overview') }}</span>
                            </div>
                            <div class="col-sm-auto">
                                <pagination></pagination>
                            </div>
                        </div>

	                    <div class="no-items-found" v-if="!collection.length > 0">
		                    <i class="icon-magnifier"></i>
		                    <h3>{{ trans('brackets/admin-ui::admin.index.no_items') }}</h3>
		                    <p>{{ trans('brackets/admin-ui::admin.index.try_changing_items') }}</p>
                            <a class="btn btn-primary btn-spinner" href="{{ url('admin/orders/create') }}" role="button"><i class="fa fa-plus"></i>&nbsp; {{ trans('admin.order.actions.create') }}</a>
	                    </div>
                    </div>
                </div>
            </div>
        </div>
    </order-listing>

@endsection