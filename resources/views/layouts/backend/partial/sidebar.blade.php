<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
            <img src="{{asset('storage/profile/'.Auth::user()->img)}}" width="48" height="48" alt="User"/>
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true"
                 aria-expanded="false">{{Auth::user()->name}}</div>
            <div class="email">{{Auth::user()->email}}</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">
                    <li>
                        @if(Request::is('admin*'))
                            <a href="{{route('admin.settings')}}"><i class="material-icons">person</i>Профайл</a>
                        @else
                            <a href="{{route('author.settings')}}"><i class="material-icons">person</i>Профайл</a>
                    </li>
                    @endif
                    </li>
                    <li role="separator" class="divider"></li>

                    <li>
                        <a href="{{route('logout')}}" class="dropdown-item "
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="material-icons">input</i>Выйти
                        </a>
                        <form id="logout-form" action="{{route('logout')}}" method="POST" style="">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">Меню упровления</li>

            @if(Request::is('admin*'))

                <li class="{{Request::is('admin/dashboard')? 'active': ''}}">
                    <a href="{{route('admin.dashboard')}}">
                        <i class="material-icons">home</i>
                        <span>Главная</span>
                    </a>
                </li>
                <li class="{{Request::is('admin/tag')? 'active': ''}}">
                    <a href="{{route('admin.tag.index')}}">
                        <i class="material-icons">label</i>
                        <span>Теги</span>
                    </a>
                </li>
                <li class="{{Request::is('admin/category')? 'active': ''}}">
                    <a href="{{route('admin.category.index')}}">
                        <i class="material-icons">apps</i>
                        <span>Категории</span>
                    </a>
                </li>
                <li class="{{Request::is('admin/post')? 'active': ''}}">
                    <a href="{{route('admin.post.index')}}">
                        <i class="material-icons">library_books</i>
                        <span>Статьи</span>
                    </a>
                </li>
                <li class="{{Request::is('admin/pending*')? 'active': ''}}">
                    <a href="{{route('admin.post.pending')}}">
                        <i class="material-icons">done</i>
                        <span>Ожидающие</span>
                    </a>
                </li>
                <li class="{{Request::is('admin/subscriber')? 'active': ''}}">
                    <a href="{{route('admin.subscriber.index')}}">
                        <i class="material-icons">subscriptions</i>
                        <span>Подписщики</span>
                    </a>
                </li>
                <li class="{{Request::is('admin/comments')? 'active': ''}}">
                    <a href="{{route('admin.comment.index')}}">
                        <i class="material-icons">comment</i>
                        <span>Комментарии</span>
                    </a>
                </li>
                <li class="{{Request::is('admin/favorite')? 'active': ''}}">
                    <a href="{{route('admin.favorite.index')}}">
                        <i class="material-icons">favorite</i>
                        <span>Понравившиеся</span>
                    </a>
                </li>
                <li class="{{Request::is('admin/authors')? 'active': ''}}">
                    <a href="{{route('admin.authors.index')}}">
                        <i class="material-icons">account_circle</i>
                        <span>Авторы</span>
                    </a>
                </li>
                <li class="header"> Система</li>
                <li class="{{Request::is('admin/settings')? 'active': ''}}">
                    <a href="{{route('admin.settings')}}">
                        <i class="material-icons">settings</i>
                        <span>Настройки</span>
                    </a>
                </li>

                <a href="{{route('logout')}}" class="dropdown-item "
                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="material-icons">input</i>
                    <span>Выйти</span>
                </a>
                <form id="logout-form" action="{{route('logout')}}" method="POST" style="">
                    @csrf
                </form>
                <li>
            @endif
            @if(Request::is('author*'))

                <li class="{{Request::is('author/dashboard')? 'active': ''}}">
                    <a href="{{route('author.dashboard')}}">
                        <i class="material-icons">home</i>
                        <span>Главная</span>
                    </a>
                </li>
                <li class="{{Request::is('author/favorite')? 'active': ''}}">
                    <a href="{{route('author.favorite.index')}}">
                        <i class="material-icons">favorite</i>
                        <span>Понравившиеся</span>
                    </a>
                </li>
                <li class="{{Request::is('author/comments')? 'active': ''}}">
                    <a href="{{route('author.comment.index')}}">
                        <i class="material-icons">comment</i>
                        <span>Комментарии</span>
                    </a>
                </li>
                <li class="{{Request::is('author/post')? 'active': ''}}">
                    <a href="{{route('author.post.index')}}">
                        <i class="material-icons">library_books</i>
                        <span>Статьи</span>
                    </a>
                </li>
                <li class="header"> Система</li>
                <li class="{{Request::is('author/settings')? 'active': ''}}">
                    <a href="{{route('author.settings')}}">
                        <i class="material-icons">settings</i>
                        <span>Настройки</span>
                    </a>
                </li>

                <a href="{{route('logout')}}" class="dropdown-item "
                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="material-icons">input</i>
                    <span>Выйти</span>
                </a>
                <form id="logout-form" action="{{route('logout')}}" method="POST" style="">
                    @csrf
                </form>
                <li>
            @endif


                </li>
        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; 2016 - 2017 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
        </div>
        <div class="version">
            <b>Version: </b> 1.0.5
        </div>
    </div>
    <!-- #Footer -->
</aside>