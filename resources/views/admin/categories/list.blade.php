@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.categories.actions.index'))

@section('body')
    <div class="lds-loader" v-if="loading" style="z-index: 999"><div></div><div></div><div></div></div>

    <categories-listing
            :data="{{ $data->toJson() }}"
            :url="'{{ url('admin/categories') }}'"
            :breadcrumbs="{{ $breadcrumbs->toJson() }}"
            :parent="'{{ $parentName }}'"
            inline-template>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> {{ trans('admin.category.actions.index') }}
                        <a class="btn btn-primary btn-spinner btn-sm pull-right m-b-0" :href="'/admin/categories/create/'+currentCategory" role="button"><i class="fa fa-plus"></i>&nbsp; {{ trans('admin.category.actions.create') }}</a>
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

                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/admin/categories">Root</a>
                                </li>
                                <li class="breadcrumb-item" v-for="(item, index) in bread">
                                    <a @click="loadData(true, 'categories/'+item.slug)">@{{ item.name }}</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <span>@{{ parentName }}</span>
                                </li>
                            </ol>
                        </nav>

                        <table class="table table-hover table-listing">
                            <thead>
                            <tr>
                                <th is='sortable' :column="'id'" :callback="function() {loadData(true, modifiedUrl);}">{{ trans('admin.customer.columns.id') }}</th>
                                <th is='sortable' :column="'name'">{{ trans('admin.customer.columns.name') }}</th>
                                <th is='sortable' :column="'slug'">{{ trans('admin.customer.columns.slug') }}</th>
                                <th is='sortable' :column="'description'">{{ trans('admin.customer.columns.description') }}</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(item, index) in collection">
                                <td>@{{ item.id }}</td>
                                <td><span @click="loadData(true, 'categories/'+item.slug)" class="cat-link">@{{ item.name }}</span></td>
                                <td>@{{ item.slug }}</td>
                                <td>@{{ item.description }}</td>
                                <td>
                                    <div class="row no-gutters">
                                        <div class="col-auto">
                                            <a class="btn btn-sm btn-spinner btn-info" :href="item.resource_url + '/edit'" title="{{ trans('brackets/admin-ui::admin.btn.edit') }}" role="button"><i class="fa fa-edit"></i></a>
                                        </div>
                                        <form class="col" @submit.prevent="deleteItem(item.resource_url, modifiedUrl)">
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
                            <a class="btn btn-primary btn-spinner" :href="'/admin/categories/create/'+currentCategory" role="button"><i class="fa fa-plus"></i>&nbsp; {{ trans('admin.categories.actions.create') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </categories-listing>

@endsection