@extends('layouts.backend')

@section('main-content')
<div class="row">
	<div class="col-md-12">
		<div class="d-flex align-items-center mb-3">
			<h4 class="flex-grow-1 mb-0">Note</h4>
			<a class="btn btn-primary flex-sharink-0 ml-2" href="{{url('notes')}}">Back</a>
		</div>

		<div class="row">
			<div class="col-md-6">
				
				<form class="preDef" id="note">
					@csrf
				
				    <div class="form-group">
				      <label for="email">Title:</label>
				      <input type="text" class="form-control" placeholder="Enter title" name="title" autocomplete="off" value="{{$note->title ?? ''}}">
				    </div>
				    <div class="form-group">
				      <label for="description">Description:</label>
				      <textarea class="form-control" placeholder="Description" name="description" autocomplete="off" rows="6">{{$note->description ?? ''}}</textarea>
				    </div>

				    @if(isset($note))
				    <input type="hidden" name="note_id" value="{{$note->note_id}}">
				    <button type="submit" class="btn btn-primary btn_action" data-form='note' data-nav='update_note'>Submit</button>
				    @else
				    <button type="submit" class="btn btn-primary btn_action" data-form='note' data-nav='create_note' data-resetform='true'>Submit</button>
				    @endif
				    
				</form>

			</div>
		</div>
	</div>
</div>
@endsection