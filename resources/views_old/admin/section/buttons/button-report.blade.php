@if(Route::has($_base_route.'.show'))
<a href="{{ URL::route($_base_route.'.show', ['unique_id' => $row->unique_id]) }}">
    <button type="button" data-original-title="Reports"  onclick="report(this)" data-toggle="tooltip" class="btn btn-info btn-sm" style="cursor:pointer;">&nbsp;रिपोर्ट</button></a>
@endif