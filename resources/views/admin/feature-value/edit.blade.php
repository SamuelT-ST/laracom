@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.feature-value.actions.edit', ['name' => $featureValue->id]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <feature-value-form
                :action="'{{ $featureValue->resource_url }}'"
                :data="{{ $featureValue->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.feature-value.actions.edit', ['name' => $featureValue->id]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.feature-value.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </feature-value-form>

        </div>
    
</div>

@endsection