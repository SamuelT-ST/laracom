@extends('brackets/admin-ui::admin.layout.default')

@section('body')
    <!-- Main content -->
    <div class="container-xl">

    <!-- Default box -->
        <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Dashboard a rýchle voľby
                </div>

                {{--<div class="card-tools pull-right">--}}
                    {{--<button type="button" class="btn btn-card-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">--}}
                        {{--<i class="fa fa-minus"></i></button>--}}
                    {{--<button type="button" class="btn btn-card-tool" data-widget="remove" data-toggle="tooltip" title="Remove">--}}
                        {{--<i class="fa fa-times"></i></button>--}}
                {{--</div>--}}
            <div class="card-body">
                Tu sa budú vyskytovať grafy a rýchle voľby.
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </div>
    <!-- /.content -->
@endsection
