<div class="col-lg-3 col-md-6">
    <a href="{{ $subcategory->front_url }}">
        <div class="single-cateogy-block-item"><!-- single category block item -->
            <div class="icon">
                <img src="{{ $subcategory->getCategoryThumb() }}">
            </div>
            <div class="conent">
                <h4 class="title">{{ $subcategory->name }}</h4>
            </div>
        </div><!-- //. single category block item -->
    </a>
</div>