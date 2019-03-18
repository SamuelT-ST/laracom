@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.customers.actions.index'))

@section('body')

    <order-listing
            :data="{{ $data->toJson() }}"
            :url="'{{ url('admin/orders') }}'"
            inline-template>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> {{ trans('admin.customers.actions.index') }}
                        <a class="btn btn-primary btn-spinner btn-sm pull-right m-b-0" href="{{ route('admin.customers.create') }}" role="button"><i class="fa fa-plus"></i>&nbsp; {{ trans('admin.customers.actions.create') }}</a>
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
                                <th is='sortable' :column="'created_at'">{{ trans('admin.customers.columns.date') }}</th>
                                <th is='sortable' :column="'customer'">{{ trans('admin.customers.columns.customer') }}</th>
                                <th is='sortable' :column="'courier'">{{ trans('admin.customers.columns.courier') }}</th>
                                <th is='sortable' :column="'total'">{{ trans('admin.customers.columns.total') }}</th>
                                <th is='sortable' :column="'status'">{{ trans('admin.customers.columns.status') }}</th>

                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(item, index) in collection">
                                <td><a :href="item.resource_url + '/edit'">@{{ item.created_at }}</a></td>
                                <td>@{{ item.customer.name }}</td>
                                <td>@{{ item.courier.name }}</td>

                                <td>@{{ item.total }}</td>
                                <td><span class="badge badge-info">@{{ item.order_status.name }}</span></td>
                                <td>
                                    <div class="row no-gutters">
                                        <div class="col-auto">
                                            <a class="btn btn-sm btn-spinner btn-info" :href="item.resource_url + '/edit'" title="{{ trans('brackets/admin-ui::admin.btn.edit') }}" role="button"><i class="fa fa-edit"></i></a>
                                        </div>
                                        {{--<form class="col" @submit.prevent="deleteItem(item.resource_url)">--}}
                                            {{--<button type="submit" class="btn btn-sm btn-danger" title="{{ trans('brackets/admin-ui::admin.btn.delete') }}"><i class="fa fa-trash-o"></i></button>--}}
                                        {{--</form>--}}
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
                            {{--<a class="btn btn-primary btn-spinner" href="{{ url('admin/orders/create') }}" role="button"><i class="fa fa-plus"></i>&nbsp; {{ trans('admin.customers.actions.create') }}</a>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </order-listing>

@endsection




{{--@extends('layouts.admin.app')--}}

{{--@section('content')--}}
    {{--<!-- Main content -->--}}
    {{--<section class="content">--}}

    {{--@include('layouts.errors-and-messages')--}}
    {{--<!-- Default box -->--}}
        {{--@if($orders)--}}
            {{--<div class="box">--}}
                {{--<div class="box-body">--}}
                    {{--<h2>Orders</h2>--}}
                    {{--@include('layouts.search', ['route' => route('admin.orders.index')])--}}
                    {{--<table class="table">--}}
                        {{--<thead>--}}
                            {{--<tr>--}}
                                {{--<td class="col-md-3">Date</td>--}}
                                {{--<td class="col-md-3">Customer</td>--}}
                                {{--<td class="col-md-2">Courier</td>--}}
                                {{--<td class="col-md-2">Total</td>--}}
                                {{--<td class="col-md-2">Status</td>--}}
                            {{--</tr>--}}
                        {{--</thead>--}}
                        {{--<tbody>--}}
                        {{--@foreach ($orders as $order)--}}
                            {{--<tr>--}}
                                {{--<td><a title="Show order" href="{{ route('admin.orders.show', $order->id) }}">{{ date('M d, Y h:i a', strtotime($order->created_at)) }}</a></td>--}}
                                {{--<td>{{$order->customer->name}}</td>--}}
                                {{--<td>{{ $order->courier->name }}</td>--}}
                                {{--<td>--}}
                                    {{--<span class="label @if($order->total != $order->total_paid) label-danger @else label-success @endif">{{ config('cart.currency') }} {{ $order->total }}</span>--}}
                                {{--</td>--}}
                                {{--<td><p class="text-center" style="color: #ffffff; background-color: {{ $order->status->color }}">{{ $order->status->name }}</p></td>--}}
                            {{--</tr>--}}
                        {{--@endforeach--}}
                        {{--</tbody>--}}
                    {{--</table>--}}
                {{--</div>--}}
                {{--<!-- /.box-body -->--}}
                {{--<div class="box-footer">--}}
                    {{--{{ $orders->links() }}--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<!-- /.box -->--}}
        {{--@endif--}}

    {{--</section>--}}
    {{--<!-- /.content -->--}}
{{--@endsection--}}