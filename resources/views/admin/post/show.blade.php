@extends('layouts.backend.app')

@section('title','Создание Статьи')
@push('css')

    <!-- Bootstrap Select Css -->
    <link href="{{asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet"/>
@endpush

@section('content')

    <a class="btn btn-danger" href="{{route('admin.post.index')}}">Назад</a>

    @if($post->is_approved==false)
        <button type="button" class="btn btn-success pull-right" onclick="approvePost({{$post->id}})">
            <i class="material-icons">done</i>
            <span>Проверено</span>
        </button>
        <form method="POST" action="{{route('admin.post.approve',$post->id)}}" id="approval-form" style="display: none">
            @csrf
            @method('PUT')

        </form>
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
                    <img class="img-responsive" src="{{asset('storage/post/'.$post->image)}}"
                         alt="{{$post->title}}">

                </div>

            </div>


        </div>
    </div>

@endsection
@push('js')
    <!-- Multi Select Plugin Js -->
    <script src="{{asset('assets/backend/plugins/multi-select/js/jquery.multi-select.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

    <script type="text/javascript">
	    function approvePost(id) {

		    const swalWithBootstrapButtons = Swal.mixin({
			    customClass: {
				    confirmButton: 'btn btn-success',
				    cancelButton: 'btn btn-danger'
			    },
			    buttonsStyling: false,
		    })

		    swalWithBootstrapButtons.fire({
			    title: 'Вы согласны?',
			    text: "Одобрить данную статью!",
			    type: 'warning',
			    showCancelButton: true,
			    confirmButtonText: 'Одобрить!',
			    cancelButtonText: 'Отклонить!',
			    reverseButtons: true
		    }).then((result) => {
			    if (result.value) {


				    swalWithBootstrapButtons.fire(
					    '',
					    'Одобрено!',
					    'success'
				    )
				    event.preventDefault();
				    document.getElementById('approval-form').submit();

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
