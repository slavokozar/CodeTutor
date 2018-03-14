<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{action('System\PropagationController@home')}}">
                <img src="{{asset('img/codeleague-logo-white.png')}}" alt="CodeLeague">
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="/">domov</a>
                </li>
                <li>
                    <a href="{{action('Articles\ArticleController@index')}}">články</a>
                </li>
                <li>
                    <a href="{{action('System\PropagationController@rules')}}">pravidlá</a>
                </li>
                <li>
                    <a href="{{action('Assignments\AssignmentController@index')}}">zadania</a>
                </li>

                @if(Auth::check() && Auth::user()->isAdmin())
                    <li>
                        <a class="btn " href="{{action('Users\UserController@index')}}">užívatelia</a>
                    </li>
                @endif

                @if(Auth::check())
                    <li class="dropdown">
                        <a class="inverse" type="button" data-toggle="dropdown">
                            {{Auth::user()->name}}<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{action('Profile\ProfileController@edit')}}">Zmeniť heslo</a></li>
                            <li><a href="{{action('Auth\LoginController@logout')}}">Odhlásiť</a></li>
                        </ul>
                    </li>
                @else
                    <li>
                        <a class="inverse" href="/login">prihlásiť sa</a>
                    </li>
                @endif


            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>