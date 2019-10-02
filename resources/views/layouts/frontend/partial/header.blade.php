<style>

    header .src-area .src-input {
        bottom: -45px;
    }

    @-moz-document url-prefix() {
        header .src-area .src-input {
            top: 17px;
        }

    }
</style>
<header>
    <div class="container-fluid position-relative no-side-padding">

        <a href="#" class="logo">ProfBlog</a>

        <div class="menu-nav-icon" data-nav-menu="#main-menu"><i class="ion-navicon"></i></div>

        <ul class="main-menu visible-on-click" id="main-menu">
            <li><a href="{{route('home')}}">Главная</a></li>
            <li><a href="#">Категории</a></li>
            <li><a href="{{route('all_post')}}">Статьи</a></li>
            @guest
                <li><a href="{{route('login')}}">Войти</a></li>
                <li><a href="{{route('register')}}">Регистрация</a></li>
            @else
                @if(Auth::user()->role->id==1)
                    <li><a href="{{route('admin.dashboard')}}">Личный кабинет</a></li>
                @elseif(Auth::user()->role->id==2)
                    <li><a href="{{route('admin.dashboard')}}">Личный кабинет</a></li>
                @endif
            @endguest

        </ul><!-- main-menu -->

        <div class="src-area">
            <form method="GET" action="{{route('search')}}">

                <button class="src-btn" type="submit"><i style="margin-bottom: 16px;" class="ion-ios-search-strong"></i>
                </button>
                <input style="margin-bottom: 50px" class="src-input" name="query" type="text" placeholder="Введите текст для поиска">
            </form>
        </div>

    </div><!-- conatiner -->
</header>