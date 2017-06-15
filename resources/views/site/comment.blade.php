<form id="comment" method="POST" action="#comment">
		@if(! \Auth::user())
		Ваше ім'я:<br>
		<input type="text" name="author" class="form-control">
		E-mail:<br>
		<input type="text" name="email" class="form-control">
		@endif
	
	Ваш коментар:<br>
	<textarea name="content" class="form-control"></textarea><br>
	<input type="hidden" name="_token" value="{{csrf_token()}}"/>
	<input type="submit" value="Отправить" src="#comm" />
</form>


  
	

