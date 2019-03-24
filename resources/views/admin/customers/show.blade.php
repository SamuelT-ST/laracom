@extends('brackets/admin-ui::admin.layout.default')

@section('body')

        <!-- Default box -->
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Zákazník
                </div>
                <table class="table">
                    <tbody>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                    </tr>
                    </tbody>
                    <tbody>
                    <tr>
                        <td>{{ $customer->id }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->email }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Adresy
                </div>
                <table class="table">
                    <tbody>
                    <tr>
                        <th>Alias</th>
                        <th>Adresa</th>
                        <th>Krajina</th>
                        <th>Status</th>
                        <th>Akcie</th>
                    </tr>
                    </tbody>
                    <tbody>
                    @foreach ($addresses as $address)
                        <tr>
                            <td>{{ $address->alias }}</td>
                            <td>{{ $address->address_1 }}</td>
                            <td>{{ $address->country->name }}</td>
                            <td>@include('layouts.status', ['status' => $address->status])</td>
                            <td>
                                <form action="{{ route('admin.addresses.destroy', $address->id) }}" method="post" class="form-horizontal">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="delete">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.customers.addresses.show', [$customer->id, $address->id]) }}" class="btn btn-default btn-sm"><i class="fa fa-eye"></i> Show</a>
                                        <a href="{{ route('admin.customers.addresses.edit', [$customer->id, $address->id]) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
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
            <div class="box-footer">
                <div class="btn-group">
                    <a href="{{ route('admin.customers.index') }}" class="btn btn-default btn-sm">Back</a>
                </div>
            </div>
        </div>
        <!-- /.box -->
    <!-- /.content -->
@endsection
