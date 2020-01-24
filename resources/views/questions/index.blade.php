@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
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
                        @include('questions._question')
                    @empty
                        <div class="alert alert-warning">
                            <strong>Sorry</strong> THere are no questions available
                        </div>
                    @endforelse
                    
                    {{$questions->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
