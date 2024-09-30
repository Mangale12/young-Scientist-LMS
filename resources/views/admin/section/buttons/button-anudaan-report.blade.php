@if(Route::has($_base_route.'.show_anudaan'))
<a href="{{ URL::route($_base_route.'.show_anudaan', ['id' => $row->id]) }}">
    <button type="button" data-original-title="Reports"  onclick="report(this)" data-toggle="tooltip" class="btn btn-info btn-sm" style="cursor:pointer;">&nbsp;रिपोर्ट</button></a>
@endif