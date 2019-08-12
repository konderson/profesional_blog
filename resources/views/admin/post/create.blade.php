@extends('layouts.backend.app')

@section('title','Создание Категории')
@push('css')


@endpush

@section('content')
    <!-- Vertical Layout -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        ДОБАВИТЬ НОВУЮ КАТЕГОРИЮ
                    </h2>

                </div>
                <div class="body">
                    <form action="{{route("admin.category.store")}}" method="POST"
                    enctype="multipart/form-data">
                        @csrf
                        <label for="email_address">Наименование Категории</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="name" class="form-control"
                                       placeholder="Введите название категории">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="file" name="image">
                        </div>
                        <a class="btn btn-danger m-t-15 waves-effect" href="{{route('admin.category.index')}}">Назад</a>
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Добавить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Vertical Layout -->

@endsection
@push('js')
@endpush