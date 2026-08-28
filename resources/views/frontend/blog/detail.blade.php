@extends('frontend.layouts.app')
@section('title')
    Chi tiết bài viết
@endsection
@section('content')
    <div class="col-sm-9">
        <div class="blog-post-area">
            <h2 class="title text-center">Latest From our Blog</h2>
            <div class="single-blog-post">
                <h3>{{$data->title}}</h3>
                <div class="post-meta">
                    <ul>
                        <li><i class="fa fa-user"></i> Mac Doe</li>
                        <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                        <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
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
                    <img src="{{asset('upload/blog/image/' .$data->image) }}" alt="">
                </a>
                <p>
                    {{ $data->description }}
                </p>
              
                <div class="pager-area">
                    <ul class="pager pull-right">
                        @if($prev)
                            <li>
                                <a href="/frontend/blogdetail/{{ $prev->id }}">
                                    Pre
                                </a>
                            </li>
                        @endif

                        @if($next)
                            <li>
                                <a href="/frontend/blogdetail/{{ $next->id }}">
                                    Next
                                </a>
                            </li>
                        @endif

                        <!-- <li><a href="#">Pre</a></li>
                        <li><a href="#">Next</a></li> -->
                    </ul>
                </div>
            </div>
        </div><!--/blog-post-area-->

        <div class="rating-area">
            <ul class="ratings">
                <li class="rate-this">Rate this item:</li>
                <li>
                    <div class="rate">
                        <div class="vote">
                            @for($i = 1; $i <= 5; $i++)
                                <div class="ratings_stars {{ $i <= $avgRate ? 'ratings_over' : '' }}">
                                    <input value="{{$i}}" type="hidden">
                                </div>
                                <!-- <div class="star_2 ratings_stars"><input value="2" type="hidden"></div>
                                <div class="star_3 ratings_stars"><input value="3" type="hidden"></div>
                                <div class="star_4 ratings_stars"><input value="4" type="hidden"></div>
                                <div class="star_5 ratings_stars"><input value="5" type="hidden"></div> -->
                            @endfor
                        </div> 
                        <span class="rate-np">{{ $avgRate }}</span>
                    </div>
                </li>
                <li class="color">(6 votes)</li>
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
        </div> --><!--Comments-->
        <div class="response-area">
            <h2 id="comment-count">{{ count($comments) }} RESPONSES</h2>
            <ul class="media-list" id="comment-list">

                @foreach($comments as $comment)
                <li class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="{{ asset('upload/user/avatar/' .$comment->avatar) }}" alt="" width="100">
                    </a>
                    <div class="media-body">
                        <ul class="sinlge-post-meta">
                            <li><i class="fa fa-user"></i>{{ $comment->name }}</li>
                            <li><i class="fa fa-clock-o"></i> {{ $comment->created_at }}</li>
                            <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                        </ul>
                        <p>{{ $comment->cmt }}</p>

                        {{-- NÚT REPLY --}}
                        <form class="reply-form">
                            @csrf
                            <input type="hidden"
                                name="id_blog" 
                                value="{{ $data->id }}">

                            <input type="hidden"
                                name="parent_id"
                                value="{{ $comment->id }}">

                            <textarea name="cmt"
                                    rows="3"
                                    placeholder="Nhập nội dung reply"></textarea>

                            <button type="submit"
                                    class="btn btn-primary">
                                <i class="fa fa-reply"></i> Reply
                            </button>
                        </form>
                        <div class="reply-list">
                            @foreach($comment->replies as $reply)
    
                                <div class="media reply-item"
                                    style="margin-left: 50px; margin-top: 20px;">
    
                                    <a class="pull-left" href="#">
                                        <img class="media-object"
                                            src="{{ asset('upload/user/avatar/' . $reply->avatar) }}"
                                            alt=""
                                            width="70">
                                    </a>
    
                                    <div class="media-body">
    
                                        <ul class="sinlge-post-meta">
                                            <li>
                                                <i class="fa fa-user"></i>
                                                {{ $reply->name }}
                                            </li>
    
                                            <li>
                                                <i class="fa fa-clock-o"></i>
                                                {{ $reply->created_at }}
                                            </li>
                                        </ul>
    
                                        <p>{{ $reply->cmt }}</p>
    
                                    </div>
    
                                </div>
    
                            @endforeach
                            
                        </div>

                    </div>
                </li>
                @endforeach

                <!-- <li class="media second-media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="images/blog/man-three.jpg" alt="">
                    </a>
                    <div class="media-body">
                        <ul class="sinlge-post-meta">
                            <li><i class="fa fa-user"></i>Janis Gallagher</li>
                            <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                            <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                        </ul>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        <a class="btn btn-primary" href=""><i class="fa fa-reply"></i>Replay</a>
                    </div>
                </li> -->
                
            </ul>					
        </div><!--/Response-area-->
        <div class="replay-box">
            <div class="row">
                <div class="col-sm-12">
                    <h2>Leave a replay</h2>
                    <form id="comment-form" action="{{ url('/blog/comment') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_blog" value="{{ $data->id }}">
                        <input type="hidden" name="parent_id" value="{{ $data->parent_id}}">
                        <div class="text-area">
                            <div class="blank-arrow">
                                <label>Your Name</label>
                            </div>
                            <span>*</span>
                            <textarea name="cmt" rows="11"></textarea>
                            <button type="submit" class="btn btn-primary" href="">post comment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!--/Repaly Box-->
    </div>
@endsection 
@section('rate')
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
                var checkLogin = "{{Auth::Check()}}";
                if(checkLogin) {
                    var rate =  $(this).find("input").val();
                    var id_blog = "{{ $data->id }}";
                    var id_user = "{{ Auth::id() }}";
                    alert(rate);
                    if ($(this).hasClass('ratings_over')) {
                        $('.ratings_stars').removeClass('ratings_over');
                        $(this).prevAll().andSelf().addClass('ratings_over');
                } else {
		        	$(this).prevAll().andSelf().addClass('ratings_over');
		        }
                $.ajax({
                    type:'POST',
                    url:'{{ url("/blog/rate/ajax")}}',
                    data:{
                        rate:rate,
                        id_blog:id_blog
                    },
                    success:function(data){
                        console.log(data);
                    }
                });
                } else{
                    alert("VUi long dang nhap de danh gia.");
                }
		    });
		});
    </script>
@endsection

@section('comment')
<script>

    //khong dung ajax
    // $('#comment-form').submit(function(e) {

    //     var checkLogin = "{{Auth::Check()}}";

    //     if(checkLogin) {
    //         var cmt = $('textarea[name="cmt"]').val();
    //         console.log(cmt);
    //     } else {
    //         e.preventDefault();
    //         alert("Vui long dang nhap de cmt")
    //     }
    // });
    $(document).ready(function(){
        $.ajaxSetup({
                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        //Dung Ajax lay cmt
       $(document).on('submit', '.reply-form', function(e) {
            e.preventDefault();
            var checkLogin = "{{Auth::Check()}}";

            if(checkLogin) {
                var form = $(this);
                var cmt = form.find('textarea[name="cmt"]').val();
                var id_blog = form.find('input[name="id_blog"]').val();
                var parent_id = form.find('input[name="parent_id"]').val();

                console.log(cmt);
                console.log("id_blog:", id_blog);
                console.log("parent_id:", parent_id);

                $.ajax({
                        type:'POST',
                        url:'{{ url("/blog/comment/ajax")}}',
                        data:{
                            cmt:cmt,
                            id_blog:id_blog,
                            parent_id:parent_id
                        },
                        success: function(data) {

                            console.log(data);

                            var reply = data.data;

                            var html = `
                                <div class="media reply-item"
                                    style="margin-left: 50px; margin-top: 20px;">

                                    <a class="pull-left" href="#">
                                        <img class="media-object"
                                            src="/upload/user/avatar/${reply.avatar}"
                                            width="70">
                                    </a>

                                    <div class="media-body">

                                        <ul class="sinlge-post-meta">
                                            <li>
                                                <i class="fa fa-user"></i>
                                                ${reply.name}
                                            </li>

                                            <li>
                                                <i class="fa fa-clock-o"></i>
                                                ${reply.created_at}
                                            </li>
                                        </ul>

                                        <p>${reply.cmt}</p>

                                    </div>

                                </div>
                            `;

                            form.closest('.media-body').find('.reply-list').append(html);

                            // Xóa nội dung textarea
                            $('textarea[name="cmt"]').val('');

                            // Tăng số lượng comment
                            var count = $('#comment-list > li.media').length;
                            $('#comment-count').text(count + ' RESPONSES');
                        }
                    });
            } else {
                alert("Vui long dang nhap de cmt")
                
            }
        });
    });
</script>
@endsection