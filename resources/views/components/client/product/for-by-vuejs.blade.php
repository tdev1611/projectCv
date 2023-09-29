@props(['products'])

<ul class="list-item clearfix" id="list_product">
    <li v-for="(product, index) in products" :key="index">
        <div style="text-align: right" v-if="product.discount > 0">
            <span style="border-radius: 11px;  padding: 4px;   background: gold;   color:aliceblue">Giảm
                @{{ new Intl.NumberFormat("de-DE").format(product.discount) }}%
            </span>
        </div>
        <div style="text-align: right" v-else>
            <span style="border-radius: 11px;  padding: 4px;  color:aliceblue">
            </span>
        </div>
        <a :href="productDetailRoute.replace(':slug', product.slug)" :title="product.name" class="thumb">
            <img :src="'{{ url('') }}' + '/' + product.images" :alt="product.title">
        </a>
        <a href="?page=detail_product" :title="product.name" class="product-name">
            @{{ product.name }}
        </a>
        <div class="price" v-if="product.discount >0">
            <span class="new">@{{ new Intl.NumberFormat("de-DE").format(product.price - Math.round((product.discount * product.price) / 100)) }}$</span>
            <span class="old">@{{ new Intl.NumberFormat("de-DE").format(product.price) }}$</span>

        </div>
        <div class="price" v-else>
            <span class="new">@{{ new Intl.NumberFormat("de-DE").format(product.price) }}$</span>
        </div>
        <div class="action clearfix">
            <a :href="productDetailRoute.replace(':slug', product.slug)" title="Xem chi tiết" class="buy-now "
                style="text-align:center">
                Xem chi tiết</a>
        </div>
    </li>

</ul>
<script>
    var app = new Vue({
        el: '#list_product',
        data: {
            products: [],
            productDetailRoute: @json(route('client.product.show', ['slug' => ':slug']))

        },
        mounted() {
            this.products = {!! json_encode($products) !!};
        },

    });
</script>