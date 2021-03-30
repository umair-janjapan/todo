@extends('layouts.backend')

@section('page-style')

<style type="text/css">
	
	/*.note{

		padding: 2px;
	    padding-bottom: 15px;
	    border: 1px solid #212529;
	    background-color: #f8f9fa;
	    margin: 2px;
	}*/

</style>

@endsection('page-style')

@section('main-content')
<div class="row">
	<div class="col-12">
		<div class="d-flex align-items-center mb-3">
			<h4 class="flex-grow-1 mb-0">Notes</h4>
			<a class="btn btn-primary flex-sharink-0 ml-2" href="{{url('note')}}">Create note</a>
		</div>

		<div class="notes_list">
			
		</div>

		<div class="loader_search_wrap" id="scroll-to">
		    <div class="loader d-none"></div>
		</div>

		<!-- status elements -->
		<input type="hidden" id="src-current" value="1">
		<input type="hidden" id="src-rowCount" value="5">
	</div>
</div>
@endsection


@section('page-script')

	<script src="{{url('public/js/notes.js')}}"></script>

@endsection