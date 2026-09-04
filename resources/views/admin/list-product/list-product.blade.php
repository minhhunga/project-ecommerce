@extends('admin.layout.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">List Products</h4>
                        <h6 class="card-subtitle">Using the most basic table markup, here’s how <code>.table</code>-based tables look in Bootstrap. All table styles are inherited in Bootstrap 4, meaning any nested tables will be styled in the same manner as the parent.</h6>
                        <h6 class="card-title m-t-40"><i class="m-r-5 font-18 mdi mdi-numeric-1-box-multiple-outline"></i> Table With Outside Padding</h6>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Member</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($product as $key => $item)
                                    @php
                                        $image = json_decode($item->image, true);
                                    @endphp
                                    <tr>
                                        <th scope="row">{{ $key+1 }}</th>
                                        <td>
                                            <img src="{{ asset('upload/product/' . $image[0]) }}" alt="{{ $item->name }}" width="100">
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->user->name ?? 'Unknown' }}</td>
                                        <td>${{ number_format($item->price, 2) }}</td>
                                        <td>
                                            @if($item->status == 1)
                                                <span class="badge badge-success">Sale</span>
                                            @else
                                                <span class="badge badge-danger">New</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('/admin/list-products/edit/' .$item->id) }}">Edit</a>
                                            <a href="{{ url('/admin/list-products/delete/' .$item->id) }}">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection