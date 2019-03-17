@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.customerGroups.actions.edit', ['name' => $group->title]))

@section('body')

    <div class="container-xl">

        <div class="card">

            <customer-group-form
                    :action="'{{ route('admin.customerGroups.update', $group->id) }}'"
                    :data="{{ $group->toJson() }}"
                    inline-template>


                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>

                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.post.actions.edit', ['name' => $group->title]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.groups.components.form-elements')
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>

                </form>


            </customer-group-form>

        </div>

    </div>

@endsection

