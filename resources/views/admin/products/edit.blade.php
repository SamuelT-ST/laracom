@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.products.actions.create'))

@section('body')


    <div class="container-xl">

        <product-form
                :categories = "{{ $categories }}"
                :action="'{{ route('admin.products.update', $product->id) }}'"
                :data="{{ $data->toJson() }}"
                inline-template>

            <div>

                <form class="form-horizontal form-create row" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>

                    <div class="card col-md-8">

                        <div class="card-header">
                            <i class="fa fa-plus"></i> {{ trans('admin.products.actions.create') }}
                        </div>

                        <div class="card-body">

                            @include('admin.products.components.form-elements')

                        </div>

                        @include('brackets/admin-ui::admin.includes.media-uploader', [
                                'mediaCollection' => app(App\Shop\Products\Product::class)->getMediaCollection('cover'),
                                'media' => $product->getThumbs200ForCollection('cover'),
                                'label' => 'Hlavný obrázok produktu'
                            ])

                        @include('brackets/admin-ui::admin.includes.media-uploader', [
                                'mediaCollection' => app(App\Shop\Products\Product::class)->getMediaCollection('images'),
                                'media' => $product->getThumbs200ForCollection('images'),
                                'label' => 'Obrázky'
                            ])

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" :disabled="submiting">
                                <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                                {{ trans('brackets/admin-ui::admin.btn.save') }}
                            </button>
                        </div>

                    </div>


                    <div class="col-md-4">

                        <div class="card">

                            <div class="card-header">
                                <i class="fa fa-plus"></i> {{ trans('admin.products.actions.combinations') }}
                            </div>

                            <div class="card-body">
                                <ul v-cloak>
                                    <li v-for="(combination, index) in form.combinations">
                                        <span>@{{ combination.attribute.name }}: @{{ combination.value.value }} - @{{ combination.price }} -
                                            <div class="btn btn-primary" @click="editCombination(index)">Upraviť</div>
                                            <div class="btn btn-warning" @click="deleteCombination(index)">Vymazat</div>
                                        </span>
                                    </li>
                                </ul>
                                <div class="btn btn-primary" @click="show">Vytvoriť kombináciu</div>
                            </div>

                        </div>

                        <div class="card">

                            <div class="card-header">
                                <i class="fa fa-plus"></i> {{ trans('admin.products.actions.categories') }}
                            </div>

                            <div class="card-body">
                                @include('admin.products.components.sidebar')
                            </div>

                        </div>


                    </div>
                </form>
                @include('admin.products.components.new-combination')

            </div>

        </product-form>


    </div>

@endsection
