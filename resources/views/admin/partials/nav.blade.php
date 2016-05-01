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
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{url('/post')}}"><i class="fa fa-line-chart" aria-hidden="true"></i>  Dashboard</a></li>
                <li><a href="{{url('/')}}"><i class="fa fa-step-backward" aria-hidden="true"></i>  Retour au site</a></li>
                <li><a href="{{url('/logout')}}"><button class='btn btn-danger btn-xs'><i class="fa fa-sign-out" aria-hidden="true"></i>  Se déconnecter</button></a></li>
            </ul>
        </div>
    </div>
</nav>