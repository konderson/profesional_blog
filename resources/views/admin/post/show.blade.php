@extends('layouts.backend.app')

@section('title','Создание Статьи')
@push('css')

    <!-- Bootstrap Select Css -->
    <link href="{{asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet"/>
@endpush

@section('content')

    <a class="btn btn-danger" href="{{route('admin.post.index')}}">Назад</a>

    @if($post->is_approved==false)
        <button type="button" class="btn btn-success pull-right">
            <i class="material-icons">done</i>
            <span>Проверено</span>
        </button>
    @else
        <button type="button" class="btn btn-success pull-right" disabled>
            <i class="material-icons">done</i>
            <span>Одобрить</span>
        </button>
    @endif
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

                    {!!$post->body!!}
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
    <script src="{{asset('assets/backend/plugins/tinymce/tinymce.js')}}"></script>
    <!-- TinyMCE -->
    <script>
		$(function () {
			//TinyMCE
			tinymce.init({
				selector: "textarea#tinymce",
				theme: "modern",
				height: 300,
				plugins: [
					'advlist autolink lists link image charmap print preview hr anchor pagebreak',
					'searchreplace wordcount visualblocks visualchars code fullscreen',
					'insertdatetime media nonbreaking save table contextmenu directionality',
					'emoticons template paste textcolor colorpicker textpattern imagetools'
				],
				toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
				toolbar2: 'print preview media | forecolor backcolor emoticons',
				image_advtab: true
			});
			tinymce.suffix = ".min";
			tinyMCE.baseURL = '{{asset('assets/backend/plugins/tinymce')}}';
		});
    </script>
@endpush
