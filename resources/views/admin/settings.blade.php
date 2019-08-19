@extends('layouts.backend.app')

@section('title','Настройки')

@push('css')

@endpush
@section('content')
    <div class="container-fluid">

        <!-- Tabs With Only Icon Title -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            TABS WITH ONLY ICON TITLE
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"
                                   role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs tab-nav-right" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#profile" data-toggle="tab">
                                    <i class="material-icons">face</i>
                                    ЛИЧНЫЕ ДАНЫЕ
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#password" data-toggle="tab">
                                    <i class="material-icons">vpn_key</i>
                                    ПАРОЛЬ
                                </a>
                            </li>

                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="profile">
                                <!-- Horizontal Layout -->
                                <div class="row clearfix">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="card">
                                            <div class="header">
                                                <h2>
                                                    HORIZONTAL LAYOUT
                                                </h2>
                                                <ul class="header-dropdown m-r--5">
                                                    <li class="dropdown">
                                                        <a href="javascript:void(0);" class="dropdown-toggle"
                                                           data-toggle="dropdown" role="button" aria-haspopup="true"
                                                           aria-expanded="false">
                                                            <i class="material-icons">more_vert</i>
                                                        </a>
                                                        <ul class="dropdown-menu pull-right">
                                                            <li><a href="javascript:void(0);">Action</a></li>
                                                            <li><a href="javascript:void(0);">Another action</a></li>
                                                            <li><a href="javascript:void(0);">Something else here</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="body">

                                                <form method="POST" action="{{route('admin.profile.update')}}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row clearfix">

                                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                            <label for="name">Имя</label>
                                                        </div>
                                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text"  name="name"
                                                                           class="form-control"
                                                                           value="{{Auth::user()->name}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row clearfix">

                                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                            <label for="email">Email адрес</label>
                                                        </div>
                                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" name="email"
                                                                           class="form-control"
                                                                           value="{{Auth::user()->email}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row clearfix">
                                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                            <label for="password_2">Пароль</label>
                                                        </div>
                                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="password" name="password"
                                                                           class="form-control"
                                                                           placeholder="Enter your password">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="row clearfix">

                                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                            <label for="about">О себе</label>
                                                        </div>
                                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                   <textarea rows="5" name="about" class="form-control">Test</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row clearfix">
                                                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                                            <button type="button"
                                                                    class="btn btn-primary m-t-15 waves-effect">
                                                                LOGIN
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- #END# Horizontal Layout -->
                                    </div>
                                    <div class="tab-pane fade" id="password">
                                        <b>Profile Content</b>
                                        <p>
                                            Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit
                                            mediocritatem
                                            an. Pri ut tation electram moderatius.
                                            Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent
                                            aliquid
                                            pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere
                                            gubergren
                                            sadipscing mel.
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Tabs With Only Icon Title -->
            </div>
        </div>
    </div>
    <input type="text" placeholder="dfff">
@endsection
@push('js')
@endpush