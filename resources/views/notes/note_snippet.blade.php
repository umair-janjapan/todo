

@if($notes)
	@foreach($notes as $note)
		
		<div class="note p-2 bg-light mb-2 border">
			<div class="d-flex mb-3">
				<h4 class="flex-grow-1">{{$note->title}}</h4>
				<div class="flex-shrink-0">
					<a class="btn btn-primary" href='{{url("note/$note->note_id")}}'><i class="fas fa-edit"></i></a>
					<a class="btn btn-danger btn_action" data-nav='delete_note' data-note='{{$note->note_id}}' data-postfunc='removeNote' href="javascript::void(0)"><i class="fas fa-times"></i></a>
				</div>
			</div>
			<div>{{$note->excerpt()}}</div>
		</div>

	@endforeach
@else

	<div class="note">
		<p>No note found.</p>
	</div>

@endif