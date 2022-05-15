@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/p" enctype="multipart/form-data" method="post">
        @csrf
        <div class="row">
            <div class="col-8 offset-2">
                <div class="row">
                    <h3>Add new post</h3>
                </div>
                <div class="row mb-3">
                    <label for="caption" class="col-md-4 col-form-label">Post Caption</label>

                    
                    <input id="caption" type="text" class="form-control @error('caption') is-invalid @enderror" name="caption" value="{{ old('caption') }}"  autocomplete="caption" autofocus>

                    @error('caption')
                        <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    
                </div>
                <!<div class="row mb-3">
                    <label for="image" class="col-md-4 col-form-label">Image</label>             
                    <input id="image" type="file" class="form-control-file @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}"  autocomplete="caption" autofocus>

                    @error('image')
                        <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    
                </div>
                <div class=" pt-3 col-4">
                    <button class="btn btn-primary form-control">Add post</button>
                </div>
                
            </div>
        </div>
    </form>
</div>
@endsection
