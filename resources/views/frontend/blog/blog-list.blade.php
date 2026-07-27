@extends('frontend.layout.master')
@section('content')
    <div class="col-sm-9">
        <div class="blog-post-area">
            <h2 class="title text-center">Latest From our Blog</h2>
            @foreach($blog as $item)
            <div class="single-blog-post">
                <h3>{{ $item->title }}</h3>
                <div class="post-meta">
                    <ul>
                        <li><i class="fa fa-user"></i> Mac Doe</li>
                        <li><i class="fa fa-clock-o"></i> {{ $item->created_at->format('H:i A') }}</li>
                        <li><i class="fa fa-calendar"></i> {{ $item->created_at->format('M j, Y') }}</li>
                    </ul>
                    <span>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                    </span>
                </div>
                <a href="{{ url('frontend/blog/detail/' .$item->id)  }}">
                    <img src="{{ asset('uploads/blog/' . $item->image) }}" alt="">
                </a>
                <p>{{ $item->description }}</p>
                <a  class="btn btn-primary" href="{{ url('frontend/blog/detail/' .$item->id)  }}">Read More</a>
            </div>
            @endforeach
            <div class="pagination-area text-center">
                {{ $blog->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection