@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="row justify-content-center mt-3">
		  <div class="col-md-8">
		    <div class="card">
		      <div class="card-body">
		        <div class="card-title">
		          <h2>Editing Answer for Question: <strong>{{$question->title}}</strong> </h2>
		        </div>
		        <hr>
		         <form action="{{route('questions.answers.update', [$question->id, $answer->id]) }}" method="post">
		          @csrf
		          @method('PATCH')
		            <div class="form-group">
		              <textarea name="body" cols="10" cols="5" class="form-control {{$errors->has('body') ? 'is-invalid' : ''}}">{{old('body', $answer->body)}}</textarea>
		              @if ($errors->has('body'))
		                <div class="invalid-feedback">
		                  <strong>{{$errors->first('body')}}</strong>
		                </div>
		              @endif
		            </div>
		            <div class="form-group">
		              <button type="submit" class="btn btn-outline-primary btn-lg"> Update</button>
		            </div>
		         </form> 
		        <hr>
		      </div>
		    </div>
		  </div>
		</div>
	</div>
@endsection