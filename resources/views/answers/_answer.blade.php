<answer :answer='{{ $answer }}' inline-template>
  <div class="media post">
    @include('shared._vote',[
      'model' => $answer,
    ]) 
    <div class="media-body">
      <form v-if='editing' @submit.prevent='update'>
        <div class="form-group">
          <textarea v-model='body' rows="10" class="form-control" required></textarea>
        </div>
        <button class="btn btn-primary" :disabled='isInvalid'> Update </button>
        <button class="btn btn-outline-secondary" type="button" v-on:click="cancel"> Cancel </button>
      </form>
      <div v-else>
        <div v-html='bodyHtml'></div>
        <div class="row">
          <div class="col-4">
            <div class="ml-auto mt-2">

              @can('update', $answer)
                  <a @click.prevent='edit' class="btn btn-sm btn-outline-info"> Edit </a>
              @endcan
              @can('delete', $answer)
              <form class="form-delete" method="post" action="{{ route('questions.answers.destroy', [$question->id,$answer->id]) }}">
                  @method("DELETE")
                  @csrf
                  <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are You Sure?')"> Delete </button>
              </form>
              @endcan
              
            </div>
          </div>
          <div class="col-4"></div>
          <div class="col-4">
            <user-info :model='{{ $answer }}' label='Answered'></user-info>
          </div>
        </div>
      </div>
    </div>
  </div>
</answer>