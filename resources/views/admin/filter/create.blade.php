@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.filter.actions.create'))

@section('body')

    <div class="container-xl">


        
        <filter-form
            :action="'{{ url('admin/filters') }}'"
            :features="{{ $features }}"
            v-cloak
            inline-template>

            <form class="form-horizontal form-create" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>

                <div class="row">

                    <div class="col-md-8">

                        <div class="card">

                            <div class="card-header">
                                <i class="fa fa-plus"></i> {{ trans('admin.filter.actions.create') }}
                            </div>

                            <div class="card-body">
                                @include('admin.filter.components.form-elements')
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" :disabled="submiting">
                                    <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                                    {{ trans('brackets/admin-ui::admin.btn.save') }}
                                </button>
                            </div>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="card">

                            <div class="card-header">
                                <i class="fa fa-pencil"></i> {{ trans('admin.filter.categories') }}
                            </div>


                            <div class="card-body">
                                @include('admin.shared.categories', ['categories' => $categories, 'selectedIds' => []])
                            </div>

                        </div>

                    </div>


                </div>


            </form>

        </filter-form>

        </div>

        </div>

    
@endsection