<div class="row justify-content-center mt-3">
  <div class="col-md-10">
    <div class="card">
      <div class="card-body">
        <div class="card-title">
          <h2>Your Answer </h2>
        </div>
        <hr>
         <form action="{{route('questions.answers.store', $question->id) }}" method="post">
          @csrf
            <div class="form-group">
              <textarea name="body" cols="10" cols="5" class="form-control {{$errors->has('body') ? 'is-invalid' : ''}}"></textarea>
              @if ($errors->has('body'))
                <div class="invalid-feedback">
                  <strong>{{$errors->first('body')}}</strong>
                </div>
              @endif
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-outline-primary btn-lg"> Submit</button>
            </div>
         </form> 
        <hr>
      </div>
    </div>
  </div>
</div>