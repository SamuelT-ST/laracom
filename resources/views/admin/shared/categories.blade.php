<ul class="checkbox-list categories-list">
    @foreach($categories as $category)
        <li>
            <div class="checkbox">
                <label>
                    <input
                            type="checkbox"
                            @if(isset($selectedIds) && in_array($category->id, $selectedIds))checked="checked" @endif
                            name="categories[]"
                            v-model="form.categories"
                            value="{{ $category->id }}">
                    {{ $category->name }}
                </label>
            </div>
        </li>
        @if($category->children->count() >= 1)
            @include('admin.shared.categories', ['categories' => $category->children, 'selectedIds' => $selectedIds])
        @endif
    @endforeach
</ul>

@section('bottom-scripts')
    <script>

        $( document ).ready(function() {

            $('.categories-list li').each(function(){
                showChildren(this);
            });


            $('.categories-list input').on('click', function () {
                showChildren(this);
            })
        });

        function showChildren(item) {
            if ($(item)[0].checked){
                $(item).closest('li').next('ul').show();
            } else {
                $(item).closest('li').next('ul').hide();
            }
        }

    </script>

@endsection