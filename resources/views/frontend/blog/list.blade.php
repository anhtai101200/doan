@extends('frontend.layouts.app')
@section('content')
<div class="col-sm-9">
    <div class="blog-post-area">
        <h2 class="title text-center">Latest From our Blog</h2>
        <div class="single-blog-post">
            @foreach($data as $row)
            <h3>{{ $row->title}}</h3>
            <div class="post-meta">
                <ul>
                    <li><i class="fa fa-user"></i> Mac Doe</li>
                    <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                    <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                </ul>
                <span>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                </span>
            </div>
            <a>
                <img src="{{asset('upload/blog/image/' . $row->image) }}" alt="">
            </a>
            <p>{{ $row->description }}</p>
            <a  class="btn btn-primary" href="/frontend/blogdetail/{{ $row->id }}">Read More</a>
            @endforeach
        </div>
        <div class="pagination-area">
            {!! $data->links('pagination::bootstrap-4') !!}
        </div>
    </div>
</div>
@endsection