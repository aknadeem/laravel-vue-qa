@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                  <div class="card-title">
                   <div class="d-flex align-items-center">
                       <h2>{{$question->title}}</h2>
                       <div class="ml-auto">
                           <a href="{{route('questions.index')}}" class="btn btn-outline-primary"> Back TO All Questions </a>
                       </div>
                   </div>    
                </div>
                <hr>
                <div class="media">
                  <div class="d-flex flex column vote-controls">
                    <a title="This question is useful " class="vote-up"> 
                      <i class="fas fa-caret-up fa-3x"></i>
                       <span class="votes-count">1234</span>
                    </a>
                   <br>
                    <a title="This question is not useful" class="vote-down off">   <i class="fas fa-caret-down fa-3x"></i>
                      <span>12</span>
                    </a>
                    <br>
                    <a title="Mark to as favorite question (Click again to undo)" class="favorite favorited mt-2"> 
                      <i class="fas fa-star fa-2x"></i>
                      <span class="favorite-counts">123</span>
                    </a>
                  </div> 
                  <div class="media-body">
                      {!! $question->body_html !!}
                      <div class="float-right">
                        <span class="text-muted">
                          Question {{$question->created_date}}
                        </span>
                        <div class="media mt-2">
                          <a href="{{$question->user->url}}" class="pr-2">
                            <img src="{{$question->user->avatar}}" alt="">
                          </a>
                          <div class="media-body mt-1">
                            <a href="{{$question->user->url}}"> {{$question->user->name}}</a>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
   @include('answers._index',[
      'answersCount' => $question->answers_count,
      'answers' => $question->answers,
    ])
    @include('answers._create')
</div>
@endsection
