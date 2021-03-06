@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.order-statuses.actions.create'))

@section('body')


    <div class="container-xl">

        <div class="card">

            <order-status-form
                    :action="'{{ route('admin.order-statuses.store') }}'"
                    inline-template>

                <form class="form-horizontal form-create" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>

                    <div class="card-header">
                        <i class="fa fa-plus"></i> {{ trans('admin.order-statuses.actions.create') }}
                    </div>

                    <div class="card-body">

                        @include('admin.order-statuses.components.form-elements')


                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>

                </form>

            </order-status-form>

        </div>

    </div>

@endsection

@section('js')
    {{--<script src="{{ asset('js/jscolor.min.js') }}" type="text/javascript"></script>--}}
@endsection
