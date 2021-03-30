@extends('layouts.frontend')

@section('main-content')
<div class="row">
	<div class="col-md-6 offset-md-3">
		<h4>Login</h4>
		@if(Session::has('success'))
			<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('success') }}</p>
		@elseif(Session::has('error'))
			<p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('error') }}</p>
		@endif
		<form class="preDef" id="login">
		    <div class="form-group">
		      <label for="email">Email:</label>
		      <input type="email" class="form-control" placeholder="Enter email" name="email" autocomplete="off">
		    </div>
		    <div class="form-group">
		      <label for="pwd">Password:</label>
		      <input type="password" class="form-control" placeholder="Enter password" name="password" autocomplete="off">
		    </div>
		    <button type="submit" class="btn btn-primary btn_action" data-form='login' data-nav='check_login'>Submit</button>
		</form>
	</div>
</div>
@endsection