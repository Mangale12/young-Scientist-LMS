<td>
    <a href="{{ URL::route($_base_route.'.edit', ['id' => $row->id, 'key'=>$udhyogName]) }}">
        <button class="btn btn-primary btn-sm m-r-5" data-toggle="tooltip" data-original-title="Edit" style="cursor: pointer;"><i class="fa fa-pencil font-14"></i></button>
    </a>
    @if($udhyogName == 'hybridbiu')
        <a href="{{ route('admin.udhyog.inventory.seed_order.create', ['key'=>$udhyogName]) }}" class="btn btn-primary btn-sm m-r-5" data-toggle="tooltip" data-original-title="Edit" style="cursor: pointer;">
            <i class="fa fa-plus font-14"></i>
        </a>
    @else
        @if (strpos(request()->url(), '/products') == false)
        <a href="{{ route('admin.udhyog.inventory.raw_materials.create', ['key'=>$udhyogName]) }}?supplier={{ $row->id }}" class="btn btn-primary btn-sm m-r-5" data-toggle="tooltip" data-original-title="Edit" style="cursor: pointer;">
                <i class="fa fa-plus font-14"></i>
            </a>
        @endif
    @endif
    @include('admin.section.buttons.button-view')
    <button id="delete" data-id="{{ $row->id }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-original-title="Delete" data-url="{{ URL::route($_base_route.'.destroy', ['id' => $row->id, 'key'=>$udhyogName]) }}{{ !empty($udhyogName) ? '?udhyog=' . $udhyogName : '' }}" style="cursor:pointer;">
        <i class="fa fa-trash-o"></i>
    </button>

</td>
