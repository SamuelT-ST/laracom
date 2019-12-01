@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.post.actions.edit', ['name' => $customer->title]))

@section('body')

    <div class="container-xl">

        <div class="card">

            <address-form
                    :customers = "{{ $customers }}"
                    :countries = "{{ $countries }}"
                    :action="'{{ route('admin.addresses.update', $address->id) }}'"
                    :data="{{ $address->toJson() }}"
                    inline-template>


                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>

                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.address.actions.edit', ['name' => $address->title]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.addresses.components.form-elements')
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>

                </form>


            </address-form>

        </div>

    </div>

@endsection

