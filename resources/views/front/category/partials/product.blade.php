<div class="col-lg-4 col-md-6">
    <div class="single-new-collection-item"><!-- single new collections -->
        <div class="thumb">
            <img :src="item.product_thumb" alt="new collcetion image">
            <product-detail-form @updated-cart="updateCart" :product="item.id" :url="'{{ route('cart.store') }}'" inline-template>
                <div class="hover">
                    <a href="#" class="addtocart" @click.prevent="addToCart">Add To Cart</a>
                </div>
            </product-detail-form>
        </div>
        <div class="content">
            <span class="category">@{{ item.categories.name }}</span>
            <a :href="item.front_url"><h4 class="title">@{{ item.name }}</h4></a>
            <div class="price"><span class="sprice">@{{ item.price }}</span> <del class="dprice">$85.00</del></div>
        </div>
    </div><!-- //. single new collections  -->
</div>