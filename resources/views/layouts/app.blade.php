<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body { font-family: 'Lato'; }
        .fa-btn { margin-right: 6px; }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ url('/') }}">
                    AlgebraCook
                </a>
            </div>
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Lijeva strana navbar: link na recepte -->
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/recipes') }}">Recepti</a></li>
				</ul>
                <!-- Desna strana navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Linkovi za Prijavu i Registraciju -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Prijava</a></li>			<!--dodala <a>-->
                        <li><a href="{{ url('/register') }}">Registracija</a></li>			<!--dodala <a>-->
                    @else
                        <li class="dropdown">
                            <!-- Dropdown menu za promjenu lozinke i odjavu -->
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/profil') }}"><i class="fa fa-btn fa-cog"></i>Profil</a></li>		<!--dodala <a>-->
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Odjava</a></li>		<!--dodala <a>-->
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    @yield('content')
    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    @yield('script')
	<!-- Ako ima grešaka stvoriti blok za ispis grešaka -->
	@if (count($errors) > 0)
		<ul>
			@foreach ($errors->all() as $error)
				<li> {{ $error }} </li>
			@endforeach
		</ul>
	@endif
    


</body>
</html>