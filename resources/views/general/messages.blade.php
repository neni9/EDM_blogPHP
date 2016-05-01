@if(Session::has('message'))
<div class="alert alert-success" role="alert">
    @if(is_array(Session::get('message')))
    <ul>
        @foreach(Session::get('message') as $message)
        <li>{{$message}}</li>
        @endforeach
    </ul>
    @else 
    <p>{{Session::get('message')}}</p>
    @endif
</div>
@endif