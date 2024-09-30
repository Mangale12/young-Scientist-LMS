@if(Route::has($_base_route.'.edit'))
<a href="{{ URL::route($_base_route.'.edit', ['unique_id' => $row->unique_id]) }}"><button type="button" data-original-title="Edit" data-toggle="tooltip" class="btn btn-primary btn-sm" style="cursor:pointer;">&nbsp;प्रोफाइल </button></a>
@endif