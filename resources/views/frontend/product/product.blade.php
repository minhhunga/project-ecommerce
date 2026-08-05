@extends('frontend.layout.master')
@section('content')
    <div class="col-sm-9">
        <div class="table-responsive cart_info">
    <table class="table table-condensed product-table">
        <thead>
            <tr class="cart_menu">
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($product as $key => $item)
                @php
                    $image = json_decode($item->image, true);
                @endphp
            <tr>
                <td class="cart_id">{{ $key + 1 }}</td>

                <td class="cart_name">
                    <a href="#">{{ $item->name }}</a>
                </td>

                <td class="cart_image">
                    @if(isset($image[0]))
                        <img width="100px" src="{{ asset('upload/product/' . $image[0]) }}" class="product-img">
                    @endif
                </td>

                <td class="price">{{ $item->price }} $</td>

                <td>
                    <a href="{{ route('product.update', $item->id) }}" class="action-btn edit">
                        <i class="fa fa-pencil-square-o"></i>
                    </a>

                    <a href="{{ route('product.delete', $item->id) }}" class="action-btn delete" onclick="return confirm('Are you sure you want to delete this product?')">
                        <i class="fa fa-times"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="text-right">
    <a href="{{ url('frontend/account/create-product') }}" class="btn btn-warning add-btn">Add New</a>
</div>
    </div>
@endsection