<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{url('/')}}"> Blog PHP</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse" aria-expanded="false" >
            <ul class="nav navbar-nav">
                <li class="active"><a href="{{url('/')}}">Home</a></li>
                @forelse($categories as $id => $title)
                <li><a href="{{url('category', [$id])}}">{{$title}}</a></li>
                @empty
                @endforelse
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check())
                <li><a href="#"><i class="fa fa-user" aria-hidden="true"></i> Connecté sous : {{\Auth::user()->name}}</a></li>
                @if(\Auth::user()->isAdmin())
                <li> <a href="{{url('/post')}}"><button class='btn btn-primary '>Dashboard </button></a></li>
                @endif
                <li> <a href="{{url('/logout')}}"><button class='btn btn-danger '>Déconnexion <i class="fa fa-sign-out" aria-hidden="true"></i></button></a></li>
                @else
                <li><a href="{{url('/login')}}">Connexion </a></li>
                <li><a href="{{url('/register')}}">Inscription </a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>