@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.product-group.actions.edit', ['name' => $productGroup['name']]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <product-group-form
                :action="'{{ $productGroup['resource_url'] }}'"
                :data="{{ $productGroup->toJson() }}"
                :available-products="{{ \App\Shop\Products\Product::all() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.product-group.actions.edit', ['name' => $productGroup['name']]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.product-group.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </product-group-form>

        </div>
    
</div>

@endsection