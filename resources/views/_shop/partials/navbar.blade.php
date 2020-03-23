<nav class="navbar navbar-default">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('home') }}">Inner Beauty Demo Shop Page</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="{{ route('view_cart') }}">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart
                        <span id="header_quantity" class="badge">
                            {{ Cart::getContent()->count() }}
                        </span>
                    </a>
                </li>
                <li class="dropdown">
                    @if( Auth::guard('web')->check() )
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    @else
                        <a href="{{ route('user_login_form') }}">
                            <i class="fa fa-user" aria-hidden="true"></i> Login
                        </a>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</nav>