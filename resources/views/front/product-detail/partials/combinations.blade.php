
<div class="mt-4">
        <h4 class="title">{{ __('Vyberte si kombináciu') }}</h4>
</div>

<div class="form-group">
        <select class="form-control attribute-select" v-model="productAttribute">
        @foreach($product->attributes as $attribute)
            @foreach($attribute->attributesValues as $attributeValue)
                <option value="{{ $attribute->id }}">{{ $attributeValue->attribute->name}} : {{ $attributeValue->value }}</option>
                {{ $attributeValue->attribute->name}}: {{ $attributeValue->value }}
            @endforeach
        @endforeach
        </select>
</div>