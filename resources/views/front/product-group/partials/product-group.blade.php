<div class="recently-added-area product-details">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="recently-added-carousel" id="group-products"><!-- recently added carousel -->
                    <template v-for="item in suitableProducts">

                        <div class="single-new-collection-item">
                            <div class="thumb">
                                <img :src="item.product_thumb" alt="new collcetion image">
                            </div>
                            <div class="content">
                                <span v-for="category in item.categories" class="category">@{{ category.name }}</span>
                                <a :href="item.front_url"><h4 class="title">@{{ item.name }}</h4></a>

                                @include('front.product-group.partials.combinations')

                                <div class="price">
                                    <span class="sprice">@{{ item.discounted_price ? item.discounted_price : item.price }} {{ \App\Shop\Products\Product::CURRENCY }}</span>
                                    <del v-if="item.discounted_price" class="dprice">@{{ item.price }} {{ \App\Shop\Products\Product::CURRENCY }}</del>
                                </div>

                            </div>
                        </div>

                    </template>
                </div><!-- //. recently added carousel -->
            </div>
        </div>
    </div>
</div>