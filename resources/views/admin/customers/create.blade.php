@extends('layouts.admin.app')

@section('content')
    <!-- Main content -->
    <section class="content">
        @include('layouts.errors-and-messages')
        <customer-form
                :groups = "{{ $groups }}"
                :action="'{{ route('admin.customers.store') }}'"
                :method="'post'"
                inline-template>


            @include('admin.customers.components.form-elements')


        </customer-form>

            <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
