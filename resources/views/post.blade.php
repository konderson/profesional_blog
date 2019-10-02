@extends('layouts.frontend.app')
@section('title','Статья')
@push('css')
    <link href="{{asset('assets/frontend/css/post/styles.css')}}" rel="stylesheet">

    <link href="{{asset('assets/frontend/css/post/responsive.css')}}" rel="stylesheet">
    <style>
        .favorite_posts {
            color: blue;
        }

        .title_big {
            color: white;
            width: 100%;
            height: 10%;
            text-align: center;
            position: relative;
            top: 40%;
        "
        }

        .header_bg {
            height: 400px;
            width: 100%;

            background-size: cover;
            background-image: url({{'/storage/post/'.$post->image}});
        }
    </style>

@endpush
@section('content')
    <div class="header_bg">
        <h1 class="title_big">Категория:@foreach($post->categories as $key=>$category)
                @if($key>0 && $key!=0)
                    {{','}}  @endif
               <a href="{{route('category.post',$category->slug)}}"><b>{{$category->name}}</b> </a>

            @endforeach
        </h1>
    </div>


    <section class="post-area section">
        <div class="container">

            <div class="row">

                <div class="col-lg-8 col-md-12 no-right-padding">

                    <div class="main-post">

                        <div class="blog-post-inner">

                            <div class="post-info">

                                <div class="left-area">
                                    <a class="avatar" href="#"><img src="{{asset('storage/profile/'.$post->user->img)}}"
                                                                    alt="Profile Image"></a>
                                </div>

                                <div class="middle-area">
                                    <a class="name" href="#"><b>{{$post->user->name}}</b></a>
                                    <h6 class="date">{{$post->created_at->diffForHumans()}}</h6>
                                </div>

                            </div><!-- post-info -->

                            <h3 class="title"><a href="#"><b>{{$post->title}}</b></a></h3>

                            <p class="para">{!! html_entity_decode($post->body) !!}</p>


                            <ul class="tags">
                                @foreach($post->tags as $tag)
                                    <li><a href="#">{{$tag->name}}</a></li>
                                @endforeach
                            </ul>
                        </div><!-- blog-post-inner -->

                        <div class="post-icons-area">
                            <ul class="post-icons">
                                <li>

                                    @guest
                                        <a href="javascript:void(0);"
                                           onclick="toastr.info('Для того чтобы добавить в список понравившихся статью ,' +
                                                'Вам необходимо зарегестрироваться','Инфо',{
                                               	closeButton:true,
                                               	progressBar:true,
                                                })"><i class="ion-heart">{{$post->favorite_to_users->count()}}</i></a>

                                    @else
                                        <a href="javascript:void(0);"
                                           onclick="document.getElementById('favorite-form-{{$post->id}}').submit();"
                                           class="{{!Auth::user()->favorite_posts->where('pivot.post_id',$post->id)->count() ==0 ?
                                            'favorite_posts' : ''}}">
                                            <i class="ion-heart">{{$post->favorite_to_users->count()}}</i></a>
                                        <form id="favorite-form-{{$post->id}}" method="POST"
                                              action="{{route('post.favorite',$post->id)}}"
                                              style="display: none;">
                                            @csrf
                                        </form>
                                    @endguest
                                </li>
                                <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                <li><a href="#"><i class="ion-eye"></i>{{$post->view_count}}</a></li>
                            </ul>

                            <ul class="icons">
                                <li>SHARE :</li>
                                <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                                <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                                <li><a href="#"><i class="ion-social-pinterest"></i></a></li>
                            </ul>
                        </div>




                    </div><!-- main-post -->
                </div><!-- col-lg-8 col-md-12 -->

                <div class="col-lg-4 col-md-12 no-left-padding">

                    <div class="single-post info-area">

                        <div class="sidebar-area about-area">
                            <h4 class="title"><b>АВТОР</b></h4>
                            <p>{{$post->user->about}}</p>
                        </div>
                        <div class="tag-area">

                            <h4 class="title"><b>КАТЕГОРИИ</b></h4>
                            <ul>
                                @foreach($post->categories as $category)
                                    <li><a href="{{route('category.post',$category->slug)}}">{{$category->name}}</a></li>
                                @endforeach
                            </ul>

                        </div><!-- subscribe-area -->

                        <div class="tag-area">

                            <h4 class="title"><b>ТЕГИ</b></h4>
                            <ul>
                                @foreach($tags as $tag)
                                    <li><a href="{{route('tag.post',$tag->slug)}}">{{$tag->name}}</a></li>
                                @endforeach
                            </ul>

                        </div><!-- subscribe-area -->

                    </div><!-- info-area -->

                </div><!-- col-lg-4 col-md-12 -->

            </div><!-- row -->

        </div><!-- container -->
    </section><!-- post-area -->


    <section class="recomended-area section">
        <div class="container">
            <div class="row">
                @foreach($randoposts as $randompost)
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100">
                            <div class="single-post post-style-1">

                                <div class="blog-image"><img src="{{asset('storage/post/'.$randompost->image)}}"
                                                             alt="Blog Image">
                                </div>

                                <a class="avatar" href="#"><img
                                            src="{{asset('storage/profile/'.$randompost->user->img)}}"
                                            alt="Profile Image"></a>

                                <div class="blog-info">

                                    <h4 class="title"><a href="#"><b>{{$randompost->title}}</b></a></h4>

                                    <ul class="post-footer">
                                        <li><a href="#"><i class="ion-heart"></i>57</a></li>
                                        <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                        <li><a href="#"><i class="ion-eye"></i>138</a></li>
                                    </ul>

                                </div><!-- blog-info -->
                            </div><!-- single-post -->
                        </div><!-- card -->
                    </div><!-- col-md-6 col-sm-12 -->
                @endforeach
            </div><!-- row -->

        </div><!-- container -->
    </section>

    <section class="comment-section">
        <div class="container">
            <h4><b>Добавьте комментарий</b></h4>
            <div class="row">

                <div class="col-lg-8 col-md-12">
                    <div class="comment-form">

                        @guest
                            <p>Для того чтобы оставить свой комментарий .Вам необходимо войти на сайт или
                                зарегестрироваться.
                             <a href="{{route('login')}}">Войти </a></p>
                             <a href="{{route('register')}}">Зарегестрироваться </a></p>

                        @else

                            <form method="post" action="{{route('comment.store',$post->id)}}">
                                @csrf
                                <div class="row">

                                    <div class="col-sm-6">

                                    <div class="col-sm-12">
									<textarea name=comment rows="2" class="text-area-messge form-control"
                                              placeholder="Введите ваш комментарий" aria-required="true"
                                              aria-invalid="false"></textarea>
                                    </div><!-- col-sm-12 -->
                                    <div class="col-sm-12">
                                        <button class="submit-btn" type="submit" id="form-submit"><b>Оставить коментарий</b>
                                        </button>
                                    </div><!-- col-sm-12 -->

                                    </div>
                                </div>
                            </form>

                    </div><!-- comment-form -->
                    @endguest

                    <h4><b>Комментарий({{$post->comments->count()}})</b></h4>

                    @foreach($post->comments as $comment)

                    <div class="commnets-area">

                        <div class="comment">

                            <div class="post-info">

                                <div class="left-area">
                                    <a class="avatar" href="#"><img src="{{asset('storage/profile/'.$comment->user->img)}}"
                                                                    alt="Profile Image"></a>
                                </div>

                                <div class="middle-area">
                                    <a class="name" href="#"><b>{{$comment->user->name}}</b></a>
                                    <h6 class="date">{{$comment->created_at}}</h6>
                                </div>

                                <div class="right-area">
                                    <h5 class="reply-btn"><a href="#"><b>Ответить</b></a></h5>
                                </div>

                            </div><!-- post-info -->

                            <p>{{$comment->comment}}</p>

                        </div>



                    </div><!-- commnets-area -->

                    @endforeach


                </div><!-- col-lg-8 col-md-12 -->

            </div><!-- row -->

        </div><!-- container -->
    </section>

    @push('js')

    @endpush

@endsection