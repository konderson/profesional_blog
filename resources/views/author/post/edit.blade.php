@extends('layouts.backend.app')

@section('title','Редактирование категории')
@push('css')

    <!-- Bootstrap Select Css -->
    <link href="{{asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet"/>

@endpush

@section('content')
    <div class="container-fluid">
        <form action="{{route("author.post.update",$post->id)}}" method="POST"
              enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <!-- Vertical Layout -->
            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                РЕДАКТИРОВАТЬ СТАТЬЮ
                            </h2>

                        </div>
                        <div class="body">

                            <label for="title"> Заголовок</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="title" id="title" class="form-control"
                                          value="{{$post->title}}">
                                </div>
                            </div>
                            <label for="image">Обложка</label>
                            <div class="form-group">
                                <input type="file" name="image">
                            </div>
                            <div class="form-group">
                                <input type="checkbox" id="publish" class="filled-in" name="status"
                                value="1"{{$post->status==true?'checked':''}}>
                                <label for="publish">Опубликовать</label>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Категория и теги
                            </h2>

                        </div>
                        <div class="body">


                            <div class="form-group form-float">
                                <div class="form-line {{$errors->has('categories')? 'focused error':''}} ">
                                    <label for="category">Выбирите категорию</label>
                                    <select name="categories[]" id="category" class="form-control show-tick"
                                            data-live-search="true" multiple>

                                        @foreach($categories as $category)
                                            <option
                                                    @foreach($post->categories as $postCategory)
                                                    {{$postCategory->id==$category->id ?'selected':''}}
                                                    @endforeach
                                                    value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label for="category">Выбирите Теги</label>
                                    <select name="tags[]" id="tags" class="form-control show-tick"
                                            data-live-search="true" multiple>

                                        @foreach($tags as $tag)
                                            <option
                                                    @foreach($post->tags as $postTag)
                                                    {{$postTag->id==$tag->id ?'selected':''}}
                                                    @endforeach
                                                    value="{{$tag->id}}">{{$tag->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <a class="btn btn-danger m-t-15 waves-effect"
                               href="{{route('author.post.index')}}">Назад</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Добавить</button>

                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Vertical Layout -->
            <!-- Vertical Layout -->

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            СОДЕРЖАНИЕ СТАТЬИ
                        </h2>

                    </div>
                    <div class="body">

                        <textarea id="tinymce" name="body">{{$post->body}}</textarea>
                    </div>
                </div>
            </div>

            <!-- #END# Vertical Layout -->
        </form>
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