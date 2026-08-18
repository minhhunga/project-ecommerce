@extends('frontend.layout.master')
@section('content')
    <section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="name">Name</td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@php
							$subtotal = 0;
						@endphp

						@foreach($cart as $key => $item)

							@php
								$image = json_decode($item['image'], true);
								$subtotal += $item['price'] * $item['qty'];
							@endphp

						<tr class="cart_item" data-id="{{ $item['id'] }}">
							<td class="cart_product">
                                    <a href=""><img width="100px" src="{{ asset('upload/product/' . $image[0]) }}" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{ $item['name'] }}</a></h4>
								<p>Web ID: {{ $item['id'] }}</p>
							</td>
							<td class="cart_price">
								<p>${{ $item['price'] }}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up" href="" data-id="{{ $item['id'] }}"> + </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="{{ $item['qty'] }}" autocomplete="off" size="2">
									<a class="cart_quantity_down" href="" data-id="{{ $item['id'] }}"> - </a>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">${{ $item['price'] * $item['qty'] }}</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="" data-id="{{ $item['id'] }}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
                    @endforeach    

					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								<input type="checkbox">
								<label>Use Coupon Code</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Use Gift Voucher</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Estimate Shipping & Taxes</label>
							</li>
						</ul>
						<ul class="user_info">
							<li class="single_field">
								<label>Country:</label>
								<select>
									<option>United States</option>
									<option>Bangladesh</option>
									<option>UK</option>
									<option>India</option>
									<option>Pakistan</option>
									<option>Ucrane</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
								
							</li>
							<li class="single_field">
								<label>Region / State:</label>
								<select>
									<option>Select</option>
									<option>Dhaka</option>
									<option>London</option>
									<option>Dillih</option>
									<option>Lahore</option>
									<option>Alaska</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
							
							</li>
							<li class="single_field zip-field">
								<label>Zip Code:</label>
								<input type="text">
							</li>
						</ul>
						<a class="btn btn-default update" href="">Get Quotes</a>
						<a class="btn btn-default check_out" href="">Continue</a>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span id="cart-subtotal">{{ $subtotal }}</span></li>
							<li>Eco Tax <span>$2</span></li>
							<li>Shipping Cost <span>Free</span></li>
							<li>Total <span id="cart-total">{{ $subtotal + 2 }}</span></li>
						</ul>
							<a class="btn btn-default update" href="">Update</a>
							<a class="btn btn-default check_out" href="{{ route('cart.checkout') }}">Check Out</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->

	<script>
		
		$(document).ready(function() {
			$('.cart_quantity_up').click(function(e) {
				e.preventDefault();
				var itemId = $(this).data('id');
				var row = $(this).closest('.cart_item');
				var input = row.find('.cart_quantity_input');
				var qty = parseInt(input.val());
				var newqty = qty + 1;

				$.ajax({
					url: '{{ route("cart.update") }}',
					method: 'POST',
					data: {
						id: itemId,
						qty: newqty,
						_token: '{{ csrf_token() }}'
					},
					success: function(response) {
						console.log(response);
						
						if(response.success) {
							input.val(newqty);
							row.find('.cart_total_price').html('$' + response.itemtotal);
							$('#cart-subtotal').html('$' + response.sum);
                			$('#cart-total').html('$' + (response.sum + 2));
						}
					},
					error: function(xhr, status, error) {
						console.error(error);
					}
				});
			});

			$('.cart_quantity_down').click(function(e) {
				e.preventDefault();
				
				var itemId = $(this).data('id');
				var row = $(this).closest('.cart_item');
				var input = row.find('.cart_quantity_input');
				var qty = parseInt(input.val());
				var newqty = qty - 1;
				

				if (qty > 1) {
					qty--;

					$.ajax({
						url: '{{ route("cart.update") }}',
						method: 'POST',
						data: {
							id: itemId,
							qty: newqty,
							_token: '{{ csrf_token() }}'
						},
						success: function(response) {
							console.log(response);
							if(response.success){
								input.val(newqty);
								row.find('.cart_total_price').html('$' + response.itemtotal);
								$('#cart-subtotal').html('$' + response.sum);
								$('#cart-total').html('$' + (response.sum + 2));
							}
						},
						error: function(xhr, status, error) {
							console.error(error);
						}
					});

				}

			});

			$('.cart_quantity_delete').click(function(e) {
				e.preventDefault();

				var itemId = $(this).data('id');
				var row = $(this).closest('.cart_item');
				$.ajax({
					url: '{{ route("cart.delete") }}',
					method: 'POST',
					data: {
						id: itemId,
						_token: '{{ csrf_token() }}'
					},
					success: function(response) {
						console.log(response);
						if(response.success) {
							row.remove();
							$('#cart-subtotal').html('$' + response.sum);
							$('#cart-total').html('$' + (response.sum + 2));
						}
						
					},
					error: function(xhr, status, error) {
						console.error(error);
					}
				});
			});

		});
	</script>	
@endsection