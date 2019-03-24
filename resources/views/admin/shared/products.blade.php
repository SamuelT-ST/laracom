@if(!$products->isEmpty())
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Meno</th>
            <th>Množstvo</th>
            <th>Cena</th>
            <th>Status</th>
            <th>Akcie</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>
                    @if($admin->hasPermission('view-product'))
                        <span>{{ $product->name }}</span>
                    @else
                        {{ $product->name }}
                    @endif
                </td>
                <td>{{ $product->quantity }}</td>
                <td>{{ config('cart.currency') }} {{ $product->price }}</td>
                <td>@include('layouts.status', ['status' => $product->status])</td>
                <td>
                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="post" class="form-horizontal">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="delete">
                        <div class="btn-group">
                            @if($admin->hasPermission('update-product'))<a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Upraviť</a>@endif
                            @if($admin->hasPermission('delete-product'))<button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Zmazať</button>@endif
                        </div>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif