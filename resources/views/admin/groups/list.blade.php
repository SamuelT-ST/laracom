@extends('layouts.admin.app')

@section('content')
    <!-- Main content -->
    <section class="content">

    @include('layouts.errors-and-messages')
    <!-- Default box -->
        @if($groups)
            <div class="box">
                <div class="box-body">
                    <h2>Customers</h2>
                    <a href="{{route('admin.customerGroups.create')}}">Create group</a>
                    <table class="table">
                        <thead>
                            <tr>
                                <td class="col-md-2">ID</td>
                                <td class="col-md-6">Title</td>
                                <td class="col-md-4">Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($groups as $group)
                            <tr>
                                <td>{{ $group->id }}</td>
                                <td>{{ $group->title }}</td>
                                <td>
                                    <form action="{{ route('admin.customerGroups.destroy', $group->id) }}" method="post" class="form-horizontal">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="delete">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.customerGroups.edit', $group->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                            <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Delete</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        @endif

    </section>
    <!-- /.content -->
@endsection