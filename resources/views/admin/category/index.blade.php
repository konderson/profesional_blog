@extends('layouts.backend.app')

@section('title','Категории')
@push('css')
    <!-- JQuery DataTable Css -->
    <link href="{{asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}"
          rel="stylesheet">
@endpush

@section('content')

    <div class="container-fluid">
        <div class="header">
            <a class="btn btn-primary waves-effect" href="{{route('admin.post.create')}}">
                <i class="material-icons">add</i>
                <span>Добавить новую статьи</span></a>
        </div>


    </div>
    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        ВСЕ СТАТЬИ
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true" aria-expanded="false">
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
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Заголовок</th>
                                <th>Тело</th>
                                <th>Автор</th>
                                <td><i class="material-icons">visibility</i></td>
                                <th>Статус</th>
                                <th>Проверен</th>
                                <th>Создан</th>
                                <th>Обнавлен</th>
                                <th> Упровление</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Заголовок</th>
                                <th>Тело</th>
                                <th>Автор</th>
                                <td><i class="material-icons">visibility</i></td>
                                <th>Статус</th>
                                <th>Проверен</th>
                                <th>Создан</th>
                                <th>Обнавлен</th>
                                <th> Упровление</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($posts as $key=>$post)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$post->title}}</td>
                                    <td>{{$post->body}}</td>
                                    <td>{{$post->user->name}}</td>
                                    <td>{{$post->view_count}}</td>
                                    <td>@if($post->status)
                                            <span class="badge bg-blue">Опубликовано</span>
                                        @else
                                            <span class="badge bg-pink">Ожидает</span>
                                        @endif
                                    </td>
                                    <td>@if($post->is_approved)
                                            <span class="badge bg-blue">Проверен</span>
                                        @else
                                            <span class="badge bg-pink">Ожидает</span>
                                        @endif
                                    </td>
                                    <td>{{$post->created_at}}</td>
                                    <td>{{$post->updated_at}}</td>
                                    <td class="text-center">
                                        <a href="{{route('admin.category.edit',$category->id)}}"
                                           class="btn btn-info waves-effect">
                                            <i class="material-icons">edit</i>
                                            <span>Изменить</span> </a>
                                        <button class="btn btn-danger waves-effect" type="button"
                                                onclick="deleteCategory({{$category->id}})">
                                            <i class="material-icons">delete</i>
                                        </button>
                                        <form id="delete-form-{{$category->id}}"
                                              action="{{route('admin.category.destroy',$category->id)}}" method="POST"
                                              style="display: none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Exportable Table -->
    </div>

@endsection
@push('js')
    <!-- Jquery DataTable Plugin Js -->
    <script src="{{asset('assets/backend/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script src=" {{asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/pages/tables/jquery-datatable.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script type="text/javascript">
        function deleteCategory(id) {

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false,
            })

            swalWithBootstrapButtons.fire({
                title: 'Вы согласны?',
                text: "Удалить данный тег из базы!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Да,удалить данную запись!',
                cancelButtonText: 'Нет,отменить!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {


                    swalWithBootstrapButtons.fire(
                        'Удалено!',
                        'Запись успешно удалена.',
                        'success'
                    )
                    event.preventDefault();
                    document.getElementById('delete-form-' + id).submit();

                } else if (
                    // Read more about handling dismissals
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Отменино',
                        'Удаление отменино',
                        'error'
                    )
                }
            })
        }
    </script>
@endpush