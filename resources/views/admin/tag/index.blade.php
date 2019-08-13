@extends('layouts.backend.app')

@section('title','Tag')
@push('css')
    <!-- JQuery DataTable Css -->
    <link href="{{asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}"
          rel="stylesheet">
@endpush

@section('content')

    <div class="container-fluid">
        <div class="header">
            <a class="btn btn-primary waves-effect" href="{{route('admin.tag.create')}}">
                <i class="material-icons">add</i>
                <span>Добавить новой тег</span></a>
        </div>


    </div>
    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        ВСЕ ТЕГИ
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
                                <th>Название</th>
                                <td>Количество статей</td>
                                <th>Создан</th>
                                <th>Обнавлен</th>
                                <th> Упровление</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Название</th>
                                <td>Количество статей</td>
                                <th>Создан</th>
                                <th>Обнавлен</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($tags as $key=>$tag)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$tag->name}}</td>
                                    <td>{{$tag->posts->count()}}</td>
                                    <td>{{$tag->created_at}}</td>
                                    <td>{{$tag->updated_at}}</td>
                                    <td class="text-center">
                                        <a href="{{route('admin.tag.edit',$tag->id)}}"
                                           class="btn btn-info waves-effect">
                                            <i class="material-icons">edit</i>
                                            <span>Изменить</span> </a>
                                        <button class="btn btn-danger waves-effect" type="button"
                                                onclick="deleteTag({{$tag->id}})">
                                            <i class="material-icons">delete</i>
                                        </button>
                                        <form id="delete-form-{{$tag->id}}"
                                              action="{{route('admin.tag.destroy',$tag->id)}}" method="POST"
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
		function deleteTag(id) {

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
					document.getElementById('delete-form-'+ id).submit();

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