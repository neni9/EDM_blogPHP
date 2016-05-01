@if(\Request::route()->getName() == 'home') 
	<header>
		<div class="container">
		    <h1>BLOG PHP <br>
		        <small>Toute l'actualité autour de ce langage décortiquée dans ce blog. </small>
		    </h1> 
		</div>
	</header>
@else 
@endif