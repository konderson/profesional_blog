@extends('layouts.backend.app')

@section('title','Создание Статьи')
@push('css')

    <!-- Bootstrap Select Css -->
    <link href="{{asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet"/>
@endpush

@section('content')

    <a class="btn btn-danger" href="{{route('author.post.index')}}">Назад</a>


    <!-- Vertical Layout -->
    <div class="row clearfix">
        <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header ">
                    <h2>
                        {{$post->title}}
                        <small>Опубликовано <strong><a href="">{{$post->user->name}} </a> </strong>
                            в {{$post->created_at->toFormattedDateString()}}</small>
                    </h2>

                </div>
                <div class="body">
                    {!!html_entity_decode($post->body)!!}
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-yellow">
                    <h2>
                        Категории
                    </h2>

                </div>
                <div class="body">
                    @foreach($post->categories as $category)
                        <span class="label bg-cyan">{{$category->name}}</span>

                    @endforeach

                </div>

            </div>
            <div class="card">
                <div class="header btn-success">
                    <h2>
                        Теги
                    </h2>

                </div>
                <div class="body">
                    @foreach($post->tags as $tag)
                        <span class="label bg-green">{{$tag->name}}</span>

                    @endforeach

                </div>

            </div>
            <div class="card">
                <div class="header bg-primary">
                    <h2>
                        Обложка
                    </h2>

                </div>
                <div class="body">
                    <img class="img-responsive" src="{{Storage::disk('public')->url('post/'.$post->image)}}"
                         alt="{{$post->title}}">

                </div>

            </div>


        </div>
    </div>

@endsection
@push('js')

    <!-- Multi Select Plugin Js -->
    <script src="{{asset('assets/backend/plugins/multi-select/js/jquery.multi-select.js')}}"></script>
@endpush
