@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.post.actions.edit', ['name' => $post['title']]))

@section('body')

<post-form
        :action="'{{ $post['resource_url'] }}'"
        :data="{{ $post->toJson() }}"
        v-cloak
        inline-template>

    <div class="container-xl">

        <div class="row">

            <div class="col-md-8">
                <div class="card">

                        <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>


                            <div class="card-header">
                                <i class="fa fa-pencil"></i> {{ trans('admin.post.actions.edit', ['name' => $post['title']]) }}
                            </div>

                            <div class="card-body">
                                @include('admin.post.components.form-elements')
                            </div>


                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" :disabled="submiting">
                                    <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                                    {{ trans('brackets/admin-ui::admin.btn.save') }}
                                </button>
                            </div>

                        </form>

                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        {{ __('Kategórie') }}
                    </div>
                    <div class="card-body">
                        @include('admin.post.components.sidebar')
                    </div>

                </div>
            </div>
        </div>
    </div>
</post-form>


@endsection