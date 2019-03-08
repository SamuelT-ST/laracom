@extends('layouts.admin.app')

@section('content')
    <!-- Main content -->
    <section class="content">
        @include('layouts.errors-and-messages')
        <div class="box">
            <form action="{{ route('admin.customerGroups.store') }}" method="post" class="form">
                <div class="box-body">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="name" placeholder="Name" class="form-control" value="{{ old('title') }}">
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="btn-group">
                        <a href="{{ route('admin.customerGroups.index') }}" class="btn btn-default">Back</a>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
