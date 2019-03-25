@extends('brackets/admin-ui::admin.layout.default')

@section('body')
    <!-- Main content -->
    <section class="content">
        @include('layouts.errors-and-messages')
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Nový produkt
            </div>
            <form action="{{ route('admin.products.store') }}" method="post" class="form" enctype="multipart/form-data">
                <div class="card-body">
                    {{ csrf_field() }}
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="sku">SKU <span class="text-danger">*</span></label>
                            <input type="text" name="sku" id="sku" placeholder="xxxxx" class="form-control" value="{{ old('sku') }}">
                        </div>
                        <div class="form-group">
                            <label for="name">Meno <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" placeholder="Meno" class="form-control" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="description">Popis </label>
                            <textarea class="form-control" name="description" id="description" rows="5" placeholder="Popis">{{ old('description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="cover">Hlavný obrázok </label>
                            <input type="file" name="cover" id="cover" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="image">Obrázky</label>
                            <input type="file" name="image[]" id="image" class="form-control" multiple>
                            <small class="text-warning"></small>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Množstvo <span class="text-danger">*</span></label>
                            <input type="text" name="quantity" id="quantity" placeholder="Množstvo" class="form-control" value="{{ old('quantity') }}">
                        </div>
                        <div class="form-group">
                            <label for="price">Cena <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-addon">EUR</span>
                                <input type="text" name="price" id="price" placeholder="Cena" class="form-control" value="{{ old('price') }}">
                            </div>
                        </div>
                        @if(!$brands->isEmpty())
                        <div class="form-group">
                            <label for="brand_id">Brand </label>
                            <select name="brand_id" id="brand_id" class="form-control select2">
                                <option value=""></option>
                                @foreach($brands as $brand)
                                    <option @if(old('brand_id') == $brand->id) selected="selected" @endif value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                        @include('admin.shared.status-select', ['status' => 0])
                        {{--@include('admin.shared.attribute-select', [compact('default_weight')])--}}
                    </div>
                    <div class="col-md-4">
                        <h4>Kategórie</h4>
                        @include('admin.shared.categories', ['categories' => $categories, 'selectedIds' => []])
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="card-footer">
                    <div class="btn-group">
                        <a href="{{ route('admin.products.index') }}" class="btn btn-default">Späť</a>
                        <button type="submit" class="btn btn-primary">Vytvoriť</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
