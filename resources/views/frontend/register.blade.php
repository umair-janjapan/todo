@extends('layouts.frontend')

@section('main-content')
<div class="row">
	<div class="col-md-6 offset-md-3">
		<h4>Register</h4>
		<form class="preDef" id="register">
		    <div class="form-group">
		      <label for="email">Email:</label>
		      <input type="email" class="form-control" placeholder="Enter email" name="email" autocomplete="off">
		    </div>
		    <div class="form-group">
		      <label for="pwd">Password:</label>
		      <input type="password" class="form-control" placeholder="Enter password" name="password" autocomplete="off">
		    </div>
		    <button type="submit" class="btn btn-primary btn_action" data-form='register' data-nav='save_user' data-resetform='true'>Submit</button>
		</form>
	</div>
</div>
@endsection