@extends('brackets/admin-ui::admin.layout.default')

@section('body')
    <!-- Main content -->
    <section class="content">
    @include('admin.layout.errors-and-messages')
    <!-- Default card -->
    <div class="card">
        <div class="card-header">
            <i class="fa fa-align-justify"></i> Atribút {{ $attribute->name }}
        </div>
        <div class="card-body">
            @if(!$values->isEmpty())
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td>Hodnoty atribútu</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($values as $item)
                            <tr>
                                <td>{{ $item->value }}</td>
                                <td>
                                    <form action="{{ route('admin.attributes.values.destroy', [$attribute->id, $item->id]) }}" class="form-horizontal" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="delete">
                                        <div class="btn-group">
                                            <button onclick="return confirm('Ste si istý?')" type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Odstrániť</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <div class="btn-group">
                <a href="{{ route('admin.attributes.values.create', $attribute->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Pridať hodnoty</a>
                <a href="{{ route('admin.attributes.index') }}" class="btn btn-warning btn-sm">Späť</a>
            </div>
        </div>
    </div>
    <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection