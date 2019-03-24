@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.categories.actions.edit', ['name' => $category->title]))

@section('body')

    <div class="container-xl">

        <div class="card">

            <category-form
                    :categories = "{{ $categories }}"
                    :parent = "{{ $category->parent }}"
                    :action="'{{ route('admin.categories.update', $category->id) }}'"
                    :data="{{ $category->toJson() }}"
                    inline-template>


                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>

                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.categories.actions.edit', ['name' => $category->name]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.categories.components.form-elements')
                    </div>

                    @include('brackets/admin-ui::admin.includes.media-uploader', [
                            'mediaCollection' => app(App\Shop\Categories\Category::class)->getMediaCollection('cover'),
                            'media' => $category->getThumbs200ForCollection('cover'),
                            'label' => 'Obrázok kategórie'
                        ])

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>

                </form>


            </category-form>

        </div>

    </div>

@endsection

