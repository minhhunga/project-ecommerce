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
                    <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="1000000" data-slider-step="5000" data-slider-value="[0,1000000]" id="sl2" ><br />
                    <b class="pull-left" id="price-min">$ 0</b> <b class="pull-right" id="price-max">$ 1000000</b>
            </div>
        </div><!--/price-range-->
        
        <div class="shipping text-center"><!--shipping-->
            <img src="{{ asset('frontend/images/home/shipping.jpg') }}" alt="" />
        </div><!--/shipping-->
    
    </div>
</div>