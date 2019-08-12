@extends('layouts.backend.app')

@section('title','Tag')
@push('css')


@endpush

@section('content')
    <!-- Vertical Layout -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        РЕДАКТИРОВАТЬ ТЕГ
                    </h2>

                </div>
                <div class="body">
                    <form action="{{route("admin.tag.update",$tag->id)}}" method="POST">
                        @csrf
                        @method("PUT")
                        <label for="email_address">Наименование Тега</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="name" class="form-control"
                                       value="{{$tag->name}}">
                            </div>
                        </div>
                        <a class="btn btn-danger m-t-15 waves-effect" href="{{route('admin.tag.index')}}">Назад</a>
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Обновить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Vertical Layout -->

@endsection
@push('js')
@endpush