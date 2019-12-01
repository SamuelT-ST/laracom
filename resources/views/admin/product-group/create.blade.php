@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.product-group.actions.create'))

@section('body')

<div class="container-xl">

    <product-group-form
            :action="'{{ url('admin/product-groups') }}'"
            :available-products="{{ \App\Shop\Products\Product::all() }}"
            v-cloak
            inline-template>

        <form class="form-horizontal form-create" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>


        <div class="row">

        <div class="col-md-8">

            <div class="card">


                <div class="card-header">
                    <i class="fa fa-plus"></i> {{ trans('admin.product-group.actions.create') }}
                </div>

                <div class="card-body">
                    @include('admin.product-group.components.form-elements')
                </div>


            </div>

            <div class="card">
                @include('admin.product-group.components.products')

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
                        {{ __('Kategórie') }}
                    </div>
                    <div class="card-body">
                    @include('admin.product-group.components.sidebar')
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        @include('brackets/admin-ui::admin.includes.media-uploader', [
                                    'mediaCollection' => app(\App\Shop\ProductGroups\ProductGroup::class)->getMediaCollection('cover'),
                                    'label' => 'Hlavný obrázok produktu'
                                ])

                        @include('brackets/admin-ui::admin.includes.media-uploader', [
                                'mediaCollection' => app(\App\Shop\ProductGroups\ProductGroup::class)->getMediaCollection('images'),
                                'label' => 'Obrázky'
                            ])
                    </div>
                </div>
            </div>

        </div>

        </form>


    </product-group-form>


</div>

    
@endsection