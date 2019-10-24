<header class="main-header">
    <a href="{{url('/')}}" class="logo">
        <span class="logo-mini"> <img src="{{url('images/logo.png')}}" alt="Clavora"></span>
        <span class="logo-lg text-left">Clavora</span>
        <span class="logo-lg text-left"><img src="{{url('images/logo.png')}}" alt="Clavora"></span>
    </a>
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu open">
                    {!! Form::open(['url' => '/logout', 'id' => 'logout-form']) !!}
                    {!! Form::button('<i class="fa fa-power-off"></i> Sign out', [
                    'type' => 'submit',
                    'class' => 'btn',
                    'onclick' => "return confirm('Are you sure you want to logout?')"
                    ]) !!}
                    {!! Form::close() !!}

                </li>
            </ul>
        </div>
    </nav>
</header> 