@extends('brackets/admin-ui::admin.layout.default')

@section('body')
    <!-- Main content -->
    <section class="content">
        @include('layouts.errors-and-messages')
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Nastaviť hodnotu pre {{ $attribute->name }}
            </div>
            <form action="{{ route('admin.attributes.values.store', $attribute->id) }}" method="post" class="form">
                <div class="card-body">
                    <div class="row">
                        {{ csrf_field() }}
                        <div class="col-md-12">

                            <div class="card-body">

                                <div class="form-group row align-items-center">
                                    <label for="name" class="col-form-label text-md-right">Hodnota</label>
                                    <div class="col-md-9 col-xl-8">
                                        <input type="text" class="form-control" id="value" name="value">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="btn-group">
                        <a href="{{ route('admin.attributes.show', $attribute->id) }}" class="btn btn-warning btn-sm">Späť</a>
                        <button type="submit" class="btn btn-primary btn-sm">Vytvoriť</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection
