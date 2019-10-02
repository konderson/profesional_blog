@extends('layouts.backend.app')

@section('title','Категории')
@push('css')
    <!-- JQuery DataTable Css -->
    <link href="{{asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}"
          rel="stylesheet">
@endpush

@section('content')


    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        СПИСОК КОММЕНТАРИЕВ
                        <span class="badge bg-blue">{{$comments->count()}}</span>
                    </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Информация о комментарии</th>
                                <th>Информация о статье</th>
                                <th> Упровление</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Информация о комментарии</th>
                                <th>Информация о статье</th>
                                <th> Упровление</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($comments as $key=>$comment)
                                <tr>
                                    <td>{{$comment->id}}</td>
                                    <td>
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#"><img class="media-object"
                                                                 src={{asset('storage/profile/'.$comment->user->img)}} width=60
                                                                 height="50"></a>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-heading">{{$comment->user->name}}
                                                    <small>{{$comment->created_at}}</small>
                                                </h4>
                                                <p>{{$comment->$comment}}</p>
                                                <a target="_blank"
                                                   href="{{route('post.details',$comment->post->slug.'#comments')}}">Ответить</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#"><img class="media-object"
                                                                 src={{asset('storage/post/'.$comment->post->image)}} width=60
                                                                 height="50"></a>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-heading">{{$comment->name}}
                                                    {{$comment->post->title}}
                                                </h4>
                                                <p>Опубликована <strong> {{$comment->post->user->name}} </strong></p>
                                                <a target="_blank"
                                                   href="{{route('post.details',$comment->post->slug)}}">Просмотреть</a>
                                            </div>
                                        </div>

                                    </td>

                                    <td class="text-center">

                                        <button class="btn btn-danger waves-effect" type="button"
                                                onclick="deleteComment({{$comment->id}})">
                                            <i class="material-icons">delete</i>
                                        </button>
                                        <form id="delete-form-{{$comment->id}}"
                                              action="{{route('admin.comment.destroy',$comment->id)}}" method="POST"
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
	    function deleteComment(id) {

		    const swalWithBootstrapButtons = Swal.mixin({
			    customClass: {
				    confirmButton: 'btn btn-success',
				    cancelButton: 'btn btn-danger'
			    },
			    buttonsStyling: false,
		    })

		    swalWithBootstrapButtons.fire({
			    title: 'Вы согласны?',
			    text: "Удалить данную статью из базы!",
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