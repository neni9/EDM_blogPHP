
<div id="sidebar-wrapper">
<section>
    <ul class="sidebar-nav">
        <li class="sidebar-brand">
            <a href="#">
                Administration
            </a>
        </li>
        <li>
        <span style="color:#fff;margin-left:20px;" >
			<i class="fa fa-user fa-5x" aria-hidden="true"></i><br>
			<span class="text-center" style="margin-left:40px;">{{(\Auth::user() ? \Auth::user()->name : '')}}</span>
        </span>
        </li>
        <li  class="{{ (\Request::route()->getName() == 'post.index') ? 'active' : '' }}">
            <a href="/post" >Dashboard</a>
        </li>
        <li class="{{ (\Request::route()->getName() == 'post.create') ? 'active' : '' }}">
            <a href="{{url('/post/create')}}">Ajouter un article</a>
        </li>
    </ul>
</section>
</div>
