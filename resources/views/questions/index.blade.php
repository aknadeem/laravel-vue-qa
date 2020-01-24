@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                   <div class="d-flex align-items-center">
                       <h4>Questions</h4>
                       <div class="ml-auto">
                           <a href="{{route('questions.create')}}" class="btn btn-outline-primary"> Ask Question </a>
                       </div>
                   </div>     
                    
                </div>

                <div class="card-body">
                    @include('layouts._messages')
                    @forelse($questions as $question)
                        <div class="media">
                            <div class="d-flex flex-column counters">
                                <div class="vote">
                                    <strong>{{$question->votes_count}}</strong> {{Str::plural('Vote', $question->votes_count)}}
                                </div>
                                <div class="status {{ $question->status }}">
                                    <strong>{{$question->answers_count}}</strong> {{Str::plural('Answer', $question->answers_count)}}
                                </div>
                                <div class="view">
                                    {{$question->views .' '. Str::plural('View', $question->views)}}
                                </div>
                            </div>
                            <div class="media-body">
                                <div class="d-flex align-items-center">
                                    <h3 class="mt-0"><a href="{{$question->url}}">{{$question->title}}</a></h3>
                                    <div class="ml-auto">
                                        @can('update', $question)
                                            <a href="{{route('questions.edit', $question->id)}}" class="btn btn-sm btn-outline-info"> Edit </a>
                                        @endcan
                                        @can('delete', $question)
                                        <form class="form-delete" method="post" action="{{ route('questions.destroy', $question->id) }}">
                                            @method("DELETE")
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are You Sure?')"> Delete </button>
                                        </form>
                                        @endcan
                                    </div>
                                </div>
                                <div class="lead">
                                    Asked by 
                                    <a href="{{$question->user->url}}">{{$question->user->name}}</a>
                                    <small class="text-muted">
                                        {{$question->created_date}}
                                    </small>
                                </div>
                                {{ $question->excerpt(250)}}
                            </div>
                        </div>
                        <hr>
                    @empty
                        <div class="alert alert-warning">
                            <strong>Sorry</strong> THere are no questions available
                        </div>
                    @endforelse
                    <div class="max-auto">
                        {{$questions->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
