@extends('brackets/admin-ui::admin.layout.default')

@section('body')
    <!-- Main content -->
    <section class="content">
        @include('layouts.errors-and-messages')
        <div class="card">
            <form action="{{ route('admin.attributes.values.store', $attribute->id) }}" method="post" class="form">
                <div class="card-body">
                    <div class="row">
                        {{ csrf_field() }}
                        <div class="col-md-12">
                            <h2>Set value for: <strong>{{ $attribute->name }}</strong></h2>

                            <div class="card-body">

                                <div class="form-group row align-items-center">
                                    <label for="name" class="col-form-label text-md-right">{{ trans('admin.article.columns.name') }}</label>
                                    <div class="col-md-9 col-xl-8">
                                        <input type="text" class="form-control" id="vakue" name="value">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="btn-group">
                        <a href="{{ route('admin.attributes.show', $attribute->id) }}" class="btn btn-warning btn-sm">Back</a>
                        <button type="submit" class="btn btn-primary btn-sm">Create</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection
