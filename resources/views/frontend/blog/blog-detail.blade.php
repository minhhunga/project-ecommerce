@extends('frontend.layout.master')
@section('content')
    <div class="col-sm-9">
        <div class="blog-post-area">
            <h2 class="title text-center">Latest From our Blog</h2>
            <div class="single-blog-post">
                <h3>{{ $blog->title }}</h3>
                <div class="post-meta">
                    <ul>
                        <li><i class="fa fa-user"></i> Mac Doe</li>
                        <li><i class="fa fa-clock-o"></i> {{ $blog->created_at->format('H:i A') }}</li>
                        <li><i class="fa fa-calendar"></i> {{ $blog->created_at->format('M j, Y') }}</li>
                    </ul>
                    <!-- <span>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                    </span> -->
                </div>
                <a href="">
                    <img src="{{ asset('uploads/blog/' . $blog->image) }}" alt="">
                </a>
                <p>
                    {{ $blog->description }}
                </p> <br>

                <div class="pager-area">
                    <ul class="pager pull-right">
                        @if($previous)
                        <li><a href="{{ url('frontend/blog/detail/' . $previous->id) }}">Pre</a></li>
                        @endif

                        @if($next)
                        <li><a href="{{ url('frontend/blog/detail/' . $next->id) }}">Next</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div><!--/blog-post-area-->

        <div class="rating-area">
            <ul class="ratings">
                <li class="rate-this">Rate this item:</li>
                <div class="rate">
                    <div class="vote">
                    @for($i=1; $i<=5; $i++)    
                        <div class="star_{{ $i }} ratings_stars 
                        {{ $i <= $avgRate ? 'ratings_over' : '' }}">
                        <input value="{{ $i }}" type="hidden"></div>
                    @endfor
                        <span class="rate-np">{{ $avgRate }}</span>
                    </div>
                </div>
                <li class="color">({{ $totalVote }} votes)</li>
            </ul>
            <ul class="tag">
                <li>TAG:</li>
                <li><a class="color" href="">Pink <span>/</span></a></li>
                <li><a class="color" href="">T-Shirt <span>/</span></a></li>
                <li><a class="color" href="">Girls</a></li>
            </ul>
        </div><!--/rating-area-->

        <div class="socials-share">
            <a href=""><img src="images/blog/socials.png" alt=""></a>
        </div><!--/socials-share-->

        <!-- <div class="media commnets">
            <a class="pull-left" href="#">
                <img class="media-object" src="images/blog/man-one.jpg" alt="">
            </a>
            <div class="media-body">
                <h4 class="media-heading">Annie Davis</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                <div class="blog-socials">
                    <ul>
                        <li><a href=""><i class="fa fa-facebook"></i></a></li>
                        <li><a href=""><i class="fa fa-twitter"></i></a></li>
                        <li><a href=""><i class="fa fa-dribbble"></i></a></li>
                        <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                    </ul>
                    <a class="btn btn-primary" href="">Other Posts</a>
                </div>
            </div>
        </div>Comments -->
        <div class="response-area"> 
            <h2>{{ count($getcomment) }} RESPONSES</h2>

            <ul class="media-list" id="comment-list">
                @foreach($getcomment as $value)
                @if($value->level==0)
                <li class="media">  
                    <a class="pull-left" href="#">
                        <img class="media-object" src="{{ asset('upload/user/avatar/' .$value->avatar_user) }}" alt="">
                    </a>
                    <div class="media-body">
                        <ul class="sinlge-post-meta">
                            <li><i class="fa fa-user"></i>{{$value->name_user}}</li>
                            <li><i class="fa fa-clock-o"></i>{{ $value->time }}</li>
                        </ul>
                        <p>{{$value->comment}}</p>
                        <a class="btn btn-primary reply" id="{{ $value->id }}" href=""><i class="fa fa-reply"></i>Reply</a>
                        
                        <!-- Form reply -->
                        <div class="reply-form" style="display:none; margin-top:15px;">
                            <form class="form-reply" action="{{ route('blog.comment') }}" method="post">
                                @csrf
                                <textarea class="form-control comment" rows="11" name="reply" placehoder="Nhập bình luận..."></textarea>
                                <input type="hidden" class="level" value="{{ $value->id }}">
                                <br>
                                <button type="submit" class="btn btn-primary">
                                    Gửi
                                </button>
                            </form>
                        </div>
                    </div>
                </li>
                @foreach($getcomment as $value1)
                @if($value1->level==$value->id)
                <li class="media second-media" id="second-list">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="{{ asset('upload/user/avatar/' .$value1->avatar_user) }}" alt="">
                    </a>
                    <div class="media-body">
                        <ul class="sinlge-post-meta">
                            <li><i class="fa fa-user"></i>{{$value1->name_user}}</li>
                            <li><i class="fa fa-clock-o"></i>{{ $value1->time }}</li>
                        </ul>
                        <p>{{$value1->comment}}</p>
                        <a class="btn btn-primary reply" id="{{ $value1->id }}" href=""><i class="fa fa-reply"></i>Reply</a>

                        <!-- form reply -->
                        <div class="reply-form" style="display:none; margin-top:15px;">
                            <form class="form-reply" action="{{ route('blog.comment') }}" method="post">
                                @csrf
                                <textarea class="form-control comment" rows="11" name="reply" placehoder="Nhập bình luận..."></textarea>
                                <input type="hidden" class="level" value="{{ $value1->id }}">
                                <br>
                                <button type="submit" class="btn btn-primary">
                                    Gửi
                                </button>
                            </form>
                        </div>
                    </div>
                </li>
                @endif
                @endforeach 
                @endif
                @endforeach
            </ul>					
         </div>
         <!-- Response-area  -->
         <div class="replay-box"> 
            <div class="row">
                <div class="col-sm-12">
                    <h2>Leave a replay</h2>
                   
                    <form action="{{ route('blog.comment') }}" method="post" id="comment">
                        @csrf
                        <div class="text-area">
                            <div class="blank-arrow">
                                <label>Your Comment</label>
                            </div>
                            <span>*</span>
                            <textarea name="comment" rows="11"></textarea>
                            <input type="hidden" name="level" value="0" >
                            <button type="submit" class="btn btn-primary" id="submit_form" href="">post comment</button>
                        </div>
                    </form>
                </div>
            </div>
         </div>
         <!-- Repaly Box  -->
    </div>
    <script>
    	
    	$(document).ready(function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
			//vote
			$('.ratings_stars').hover(
	            // Handles the mouseover
	            function() {
	                $(this).prevAll().andSelf().addClass('ratings_hover');
	                // $(this).nextAll().removeClass('ratings_vote'); 
	            },
	            function() {
	                $(this).prevAll().andSelf().removeClass('ratings_hover');
	                // set_votes($(this).parent());
	            }
	        );

			$('.ratings_stars').click(function(){

                var checkLogin= "{{ Auth::check() }}";
                if(checkLogin){
                    var rate =  $(this).find("input").val();
                    // alert(rate);

                    if ($(this).hasClass('ratings_over')) {
                        $('.ratings_stars').removeClass('ratings_over');
                        $(this).prevAll().andSelf().addClass('ratings_over');

                    } else {

                        $(this).prevAll().andSelf().addClass('ratings_over');
                    }

                    $.ajax({
                        type: "POST",
                        url: '{{ url("/frontend/blog/detail/rate") }}',
                        data: {
                            rate: rate,
                            id_blog: "{{ $blog->id }}",
                        },
                        success: function(response) {
                            console.log(response);
                        }
                    });
                }else{
                    alert('Vui lòng đăng nhập để đánh giá.');
                }
					
		    });

            $('form#comment').submit(function(e){
                e.preventDefault();
                var checkLogin= "{{ Auth::check() }}";
                
                if(checkLogin){
                    
                    var comment = $('textarea[name="comment"]').val();
                    var level = $('input[name="level"]').val();
                    $.ajax({
                        type: "POST",
                        url: '{{ url("/frontend/blog/detail/comment") }}',
                        data: {
                            comment: comment,
                            level: level,
                            id_blog: "{{ $blog->id }}",
                        },
                        success: function(response) {

                            var html = `

                                <li class="media">
                                    <a class="pull-left" href="#">
                                        <img class="media-object" src="/upload/user/avatar/${response.avatar_user}">
                                    </a>

                                        <div class="media-body">

                                        <ul class="sinlge-post-meta">
                                            <li><i class="fa fa-user"></i>${response.name_user}</li>
                                            <li><i class="fa fa-clock-o"></i>${response.time}</li>  
                                        </ul>

                                        <p>${response.comment}</p>
                                        

                                    </div>
                                </li>`;

                            // thêm comment mới vào đầu danh sách
                            $("#comment-list").prepend(html);

                            // xóa nội dung textarea
                            $('textarea[name="comment"]').val('');

                        }
                    });
                }else{
                    alert('Vui lòng đăng nhập để bình luận.');
                }
            })

            $('.reply').click(function(e){
                e.preventDefault();

                $('.reply-form').hide();
                $(this).next('.reply-form').show();
                $(this).next('.reply-form').find('textarea').focus();
                
            });

            $('form.form-reply').submit(function(e){
                e.preventDefault();
                var form = $(this);
                var checkLogin= "{{ Auth::check() }}";
                
                if(checkLogin){
                    var comment = $(this).find('textarea[name="reply"]').val();
                    var level = $(this).find('input.level').val();
                    $.ajax({
                        type: "POST",
                        url: '{{ url("/frontend/blog/detail/comment") }}',
                        data: {
                            comment: comment,
                            level: level,
                            id_blog: "{{ $blog->id }}",
                        },
                        success: function(response) {
                            var html = `
                                <li class="media second-media">
                                    <a class="pull-left" href="#">
                                        <img class="media-object" src="/upload/user/avatar/${response.avatar_user}">
                                    </a>

                                        <div class="media-body">

                                        <ul class="sinlge-post-meta">
                                            <li><i class="fa fa-user"></i>${response.name_user}</li>
                                            <li><i class="fa fa-clock-o"></i>${response.time}</li>  
                                        </ul>

                                        <p>${response.comment}</p>
                                        <a class="btn btn-primary reply" id="{{ $value1->id }}" href=""><i class="fa fa-reply"></i>Reply</a>

                                        <div class="reply-form" style="display:none; margin-top:15px;">
                                            <form class="form-reply" action="{{ route('blog.comment') }}" method="post">
                                                @csrf
                                                <textarea class="form-control comment" rows="11" name="reply" placehoder="Nhập bình luận..."></textarea>
                                                <input type="hidden" class="level" value="{{ $value1->id }}">
                                                <br>
                                                <button type="submit" class="btn btn-primary">
                                                    Gửi
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </li>`;
                            $("#second-list").before(html);
                            form.find('textarea[name="reply"]').val('');
                            form.closest('.reply-form').hide();
                        }
                    });
                }else{
                    alert('Vui lòng đăng nhập để bình luận.');
                }
            })
		});
    </script>
@endsection