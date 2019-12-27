@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                   <div class="d-flex align-items-center">
                       <h4>Ask Question</h4>
                       <div class="ml-auto">
                           <a href="{{route('questions.index')}}" class="btn btn-outline-primary"> Back To All Questions </a>
                       </div>
                   </div>    
                </div>
                <div class="card-body">
                    <form action="{{ ($question->id) ? route('questions.update', $question->id ) : route('questions.store') }}" method="post">
                        @csrf
                        @if($question->id)
                            @method('PUT')
                        @else
                            @method('POST')
                        @endif
                        <div class="form-group">
                            <label for="q_title">Question Title </label>
                            <input type="text" name="title" id="q_title" value="{{ old('title', $question->title) }}" class="form-control {{$errors->has('title') ? 'is-invalid' : ''}}">
                            @if($errors->has('title'))
                                <div class="invalid-feedback">
                                    <strong>{{$errors->first('title')}}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="q_body">Explan Your Question </label>
                            <textarea name="body" id="q_body" rows="5" class="form-control {{$errors->has('body') ? 'is-invalid' : ''}}">{{ old('body' , $question->title) }}</textarea>
                            @if($errors->has('body'))
                                <div class="invalid-feedback">
                                    <strong>{{$errors->first('body')}}</strong>
                                </div>
                            @endif 
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-primary"> Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.onload = function() {
            document.getElementById("q_title").focus();
        }
    </script>
</div>
@endsection
