@if ($answersCount > 0)
  <div class="row justify-content-center mt-3" v-cloak> {{-- v instance ready v-cloak directive is removed --}}
    <div class="col-md-10">
      <div class="card">
        <div class="card-body">
          <div class="card-title">
            <h2>{{$answersCount .' '. Str::plural('Answer', $answersCount)}}</h2>
          </div>
          <hr>
          @include('layouts._messages')
          @foreach ($answers as $answer)
            @include('answers._answer')
          @endforeach
        </div>
      </div>
    </div>
  </div>
@endif
