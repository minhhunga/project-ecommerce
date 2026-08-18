<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>Category</h2>
        <div class="panel-group category-products" id="accordian"><!--category-productsr-->

        @foreach($category as $key => $value)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordian" href="">
                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                            {{ $value->name }}
                        </a>
                    </h4>
                </div>
            </div>
        @endforeach
        </div><!--/category-products-->
    
        <div class="brands_products"><!--brands_products-->
            
            <h2>Brands</h2>
            <div class="brands-name">
                @foreach($brand as $key => $value)
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="#">{{ $value -> name }}</a></li>
                </ul>
                @endforeach
            </div>
                
        </div><!--/brands_products-->
        
        <div class="price-range"><!--price-range-->
            <h2>Price Range</h2>
            <div class="well text-center">
                    <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="10000" data-slider-step="500" data-slider-value="[0,10000]" id="sl2" ><br />
                    <b class="pull-left" id="price-min">$ 0</b> <b class="pull-right" id="price-max">$ 10000</b>
            </div>
        </div><!--/price-range-->
        
        <div class="shipping text-center"><!--shipping-->
            <img src="{{ asset('frontend/images/home/shipping.jpg') }}" alt="" />
        </div><!--/shipping-->
    
    </div>
</div>

<script>
    $(document).ready(function (){
        $('#sl2').on('slideStop', function(event){
            var minPrice = parseInt(event.value[0]);
            var maxPrice = parseInt(event.value[1]);

            $.ajax({
                url: "{{ route('frontend.search-price') }}",
                method: "GET",
                data: {
                    minPrice: minPrice,
                    maxPrice: maxPrice
                },
                success: function(response) {

                    console.log(response);
                    if(response.product && response.product.length > 0){

                        var product = response.product;
                        var html = '';
                        $.map(product, function(value, key){
                            var image = JSON.parse(value.image);
                            var firstImage = image[0];        
                            html += `
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <a href=""><img width="200px" src="{{ asset('upload/product/') }}/${firstImage}" alt=""></a>
                                                <h2>${value.price}</h2>
                                                <p>${value.name}</p>
                                                <a href="" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                            </div>
                                            <div class="product-overlay">
                                                <div class="overlay-content">
                                                    <h2>${value.price}</h2>
                                                    <p>${value.name}</p>
                                                    <a href="{{ url('/frontend/product-detail') }}/${value.id}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Xem sản phẩm</a>
                                                    <a href="#" id="${value.id}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="choose">
                                            <ul class="nav nav-pills nav-justified">
                                                <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                                <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            `;
                        });
                           
                    }else{
                        html = `
                            <div class="col-sm-12 text-center">
                                <h4>Can't find any product in this price range.</h4>
                            </div>
                        `;
                    }
                    $('.features_items').html(html);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            })
        })
    })
</script>