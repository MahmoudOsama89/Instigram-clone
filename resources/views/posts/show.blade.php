@extends("layouts.app")
@section("content")
<div class="container">
	<div class="row">
		<div class="col-8">
			<img class="w-100" src="/storage/{{$post->image}}">
		</div>
		<div class="col-4">
			<div class="d-flex align-items-center">
				<div >
					<img style="max-width: 60px;" class="w-100 rounded-circle" src="/storage/{{$post->user->profile->profileImage()}}">
				</div>
				<div style="padding-left:5%">
					<a class="text-dark" style="text-decoration: none;font-weight:bold;" href="/profile/{{$post->user->id}}">
						{{$post->user->username}}
					</a> |
					<a href="#">follow</a>
				</div> 
				
					
				
				
			</div>
			<hr>
			<p>
				<span>
					<a class="text-dark" style="font-weight: bold;text-decoration: none" href="/profile/{{$post->user->id}}">
						{{$post->user->username}}	
					</a>
				</span>
				{{$post->caption}}
			</p>
			<hr>
			<div class="row pb-4 pt-4">
				<form action="/like/{{$post->id}}" method="post">
					@csrf
					<button class="btn col-3 btn-primary" type="submit">{{$isLiked}}</button>
				</form>
				
			</div>
			<div class="row">
					@foreach($comments as $comment)
						<div class="row pb-4 d-flex">
							<div class="col-2">
								<a href="/profile/{{$comment->user->id}}">
									<img class="w-100 rounded-circle" style="max-width: 30px" src="/storage/{{$comment->user->profile->profileImage()}}">
								</a>
								
							</div>
							<div class="col-4">{{$comment->user->username}}</div>
							<div class="col-5">
								{{$comment->comment}}
							</div>
							
						</div>
						
					@endforeach
					<form action="/comment/{{$post->id}}" enctype="multipart/form-data" method="post">
						@csrf
						<textarea name="comment"></textarea>
						<button type="submit" class="btn btn-primary">Add Comment</button>
				</div>
		</div>
	</div>
</div>
@endsection
