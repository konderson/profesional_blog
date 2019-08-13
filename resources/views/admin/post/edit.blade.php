@extends('layouts.backend.app')

@section('title','Редактирование категории')
@push('css')


@endpush

@section('content')
    <div class="container-fluid">
        <form action="{{route("admin.post.update",$post->id)}}" method="POST"
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
                                            <option value="{{$category->id}}">{{$category->name}}</option>
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
                                            <option value="{{$tag->id}}">{{$tag->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <a class="btn btn-danger m-t-15 waves-effect"
                               href="{{route('admin.category.index')}}">Назад</a>
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

                        <textarea id="tinymce" name="body"></textarea>
                    </div>
                </div>
            </div>

            <!-- #END# Vertical Layout -->
        </form>
    </div>

@endsection
@push('js')
@endpush