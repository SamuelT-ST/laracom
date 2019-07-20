@extends('brackets/admin-ui::admin.layout.default')

@section('body')
    <!-- Main content -->
    <section class="content">
    @include('layouts.errors-and-messages')
    <!-- Default box -->
        @if(!$products->isEmpty())
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> {{ trans('admin.products.actions.index') }}
                    <a class="btn btn-primary btn-spinner btn-sm pull-right m-b-0" href="{{ route('admin.products.create') }}" role="button"><i class="fa fa-plus"></i>&nbsp; {{ trans('admin.products.actions.create') }}</a>
                </div>
                <div class="card-body">
{{--                    @include('layouts.search', ['route' => route('admin.products.index')])--}}
                    @include('admin.shared.products')
                    {{ $products->links() }}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        @endif

    </section>
    <!-- /.content -->
@endsection
