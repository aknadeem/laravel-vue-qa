<a title="Mark to as favorite question (Click again to undo)" class="favorite mt-2 {{ Auth::guest() ? 'off' : ($model->is_favourited ? 'favorited' : '') }} " onclick="event.preventDefault(); document.getElementById('favourite-question-{{$model->id}}').submit();"> 
<i class="fas fa-star fa-2x"></i>
<span class="favorite-counts">{{$model->favourites_count}}</span>
</a>
<form id='favourite-question-{{$model->id}}' action="/questions/{{$model->id}}/favourites" method="POST" style='display:none;'>
@csrf
@if($model->is_favourited)
  @method('DELETE')
@endif
</form>