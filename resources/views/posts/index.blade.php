@extends("layouts.app")
@section("content")
<div class="container">
	@foreach($posts as $post)
	<div class="d-flex align-items-center pb-3 offset-2">
		<div>
				<img style="max-width: 50px;" class="w-100 rounded-circle" src="/storage/{{$post->user->profile->profileImage()}}">
		</div>
		<div style="padding-left:5%">
			<a class="text-dark" style="text-decoration: none;font-weight:bold;" href="/profile/{{$post->user->id}}">
							{{$post->user->username}}
			</a> 
						
		</div> 			
	</div>
		<div class="row offset-2">
			<div class="col-8">
				<a href="/p/{{$post->id}}"><img class="w-100" src="/storage/{{$post->image}}"></a>
				
			</div>
		</div>	
		<div class="row offset-2">	
			<div class="col-4">
				<p>
					<span>
						<a class="text-dark" style="font-weight: bold;text-decoration: none" href="/profile/{{$post->user->id}}">
							{{$post->user->username}}	
						</a>
					</span>
					{{$post->caption}}
				</p>
				
				<div class="row">
					<form action="/comment/{{$post->id}}" method="post">
						<textarea name="comment"></textarea>
						<button type="submit" class="btn btn-primary">Add Comment</button>
				</div>
			</div>
		</div>
	@endforeach
	<div class="col-12 d-flex justify-content-center">
		{{$posts->links()}}
	</div>
</div>
@endsection