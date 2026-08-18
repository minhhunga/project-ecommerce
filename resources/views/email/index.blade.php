<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        
        <style type="text/css">
        	div.demo {
        		width: 50px;
        		height: 50px;
        		display: inline-block;
        		background: blue;
        	}
        	table {
        		max-width: 100%;
    			background-color: transparent;
        	}
        	thead {
        		    display: table-header-group;
				    vertical-align: middle;
				    border-color: inherit;
        	}
        	tbody {
        			display: table-row-group;
				    vertical-align: middle;
				    border-color: inherit;
        	}
        </style>
    </head>
    <body>
       <div class="demo"></div>
        <p>Thông tin khách hàng:</p>
        <p>Full name: {{ $user->name }}</p>
        <p>Email: {{ $user->email }}</p>
        <p>Phone: {{ $user->phone }}</p>
        <p>Address: {{ $user->address }}</p>
    	<p>Thong tin giỏ hàng:</p>
        <table class="table table-condensed">
            <thead>
                <tr class="cart_menu">
                    <td class="image">Item</td>
                    <td class="description">Name</td>
                    <td class="price">Price</td>
                    <td class="quantity">Quantity</td>
                    <td class="total">Total</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart as $item)
                    @php
                        $image = json_decode($item['image'], true);
                    @endphp
                <tr>
                    <td class="cart_product">
                        <a href=""><img width="100px" src="{{ asset('upload/product/' .$image[0]) }}" alt=""></a>
                    </td>
                    <p>{{ asset('upload/product/' . $image[0]) }}</p>
                    <td class="cart_description">
                        <h4><a href="">{{ $item['name'] }}</a></h4>
                        <p>Web ID: {{ $item['id'] }}</p>
                    </td>
                    <td class="cart_price">
                        <p>${{ $item['price'] }}</p>
                    </td>
                    <td class="cart_quantity">
                        <div class="cart_quantity_button">
                        
                            <input class="cart_quantity_input" type="text" name="quantity" value="{{ $item['qty'] }}" autocomplete="off" size="2">
                            
                        </div>
                    </td>
                    <td class="cart_total">
                        <p class="cart_total_price">${{ $item['price'] * $item['qty'] }}</p>
                    </td>
                    
                </tr>
                @endforeach

                <tr>
                    <td colspan="4">&nbsp;</td>
                    <td colspan="2">
                        <table class="table table-condensed total-result">
                            <tr>
                                <td>Cart Sub Total</td>
                                <td>${{ $sum }}</td>
                            </tr>
                            <tr>
                                <td>Exo Tax</td>
                                <td>$2</td>
                            </tr>
                            <tr class="shipping-cost">
                                <td>Shipping Cost</td>
                                <td>Free</td>										
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td><span>${{ $sum + 2 }}</span></td>
                            </tr>
                            
                        </table>

                    </td>
                </tr>
            </tbody>

		</table>
    </body>
</html>