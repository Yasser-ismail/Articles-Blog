<nav class="navbar navbar-expand-lg fixed-top  ">
    <div class="container">
        <div class="navbar-translate">
            <a class="navbar-brand" href="{{route('welcome')}}" rel="tooltip" data-placement="bottom">
                {{trans('main.logo')}}
            </a>
            <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navigation"
                    aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
                @if(Auth::user())
                    @if(Auth::user()->isadmin())
                        <li class="nav-item">
                            <!-- Example single danger button -->
                            <div class="btn-group">
                                <a class="nav-link" href="{{route('admin.home')}}">
                                    {{trans('main.adminPanel')}}
                                </a>
                            </div>
                        </li>
                    @endif
                @endif
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ trans('main.login')  }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ trans('main.register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <!-- Example single danger button -->
                        <div class="btn-group">
                            <a class="nav-link" href="{{route('home')}}">
                                {{trans('main.home')}}
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <ul class="list-unstyled">
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{trans('main.logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <form class="form-inline ml-auto nav-link" style="margin: 0" action="{{route('home')}}">
                            <div class="form-group has-white">
                                <input type="text" class="form-control" name="search" id="search"
                                       placeholder="{{trans('main.search')}}">
                            </div>
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
