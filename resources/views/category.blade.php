@extends('layouts.frontend.app')
@section('title','Статья')
@push('css')
    <link href="{{asset('assets/frontend/css/category/styles.css')}}" rel="stylesheet">

    <link href="{{asset('assets/frontend/css/category/responsive.css')}}" rel="stylesheet">
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
            background-image: url({{'/storage/category/'.$category->img}});
        }
    </style>

@endpush
@section('content')
    <div class="header_bg">
        <h1 class="title_big">{{$category->name}}</h1>
    </div>


    <section class="blog-area section">
        <div class="container">
            <div class="infinite-scroll">
                <div class="row ">

                    @if($posts->count()>0)
                        @foreach($posts as $post)
                            <div class="col-lg-4 col-md-6">
                                <div class="card h-100">
                                    <div class="single-post post-style-1">

                                        <div class="blog-image"><img src="{{asset('storage/post/'.$post->image)}}"
                                                                     alt="{{$post->title}}"></div>

                                        <a class="avatar" href="#"><img src="{{asset('storage/post/'.$post->image)}}"
                                                                        alt="{{$post->title}}"></a>

                                        <div class="blog-info">

                                            <h4 class="title"><a
                                                        href="{{route('post.details',$post->slug)}}"><b>{{$post->title}}</b></a>
                                            </h4>

                                            <ul class="post-footer">
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
                                                <li><a href="#"><i
                                                                class="ion-chatbubble"></i>{{$post->comments->count()}}
                                                    </a></li>
                                                <li><a href="#"><i class="ion-eye"></i>{{$post->view_count}}</a></li>
                                            </ul>

                                        </div><!-- blog-info -->
                                    </div><!-- single-post -->
                                </div><!-- card -->
                            </div><!-- col-lg-4 col-md-6 -->

                        @endforeach
                    @else
                    <h2 class="alert-info">По данной категории</h2>
                    @endif

                </div>
            </div><!-- row -->


        </div><!-- container -->
    </section><!-- section -->




    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.4.1/jquery.jscroll.min.js"></script>



        <script type="text/javascript">

            $(function () {
                $('ul.pagination').hide();
                $('.infinite-scroll').jscroll(
                    {
                        autoTrigger: true,
                        loadingHtml: '<img class="center-block" style="width:50px;height:50px;" src="{{'/storage/loading.gif'}}" alt="Loading..." />',
                        padding: 0,
                        nextSelector: '.pagination li.active + li a',
                        contentSelector: 'div.infinite-scroll',
                        callback: function () {
                            $('ul.pagination').remove();
                        }
                    }
                );
            });
        </script>

    @endpush

@endsection