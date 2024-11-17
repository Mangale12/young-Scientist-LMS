<tbody>
@if(count($data['rows']) > 0)
    @foreach ($data['rows'] as $key=>$row)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $row->fiscalYear ? $row->fiscalYear->fiscal_np : 'N/A' }}</td>
            <td>{{ $row->subject }}</td>
            <td>{{ $row->branch ? $row->branch->name : 'N/A' }}</td>
            <td>{{ $row->name }}</td>
            <td>{{ $row->chalani_no }}</td>
            <td>{{ $row->added_date }}</td>
            <td>{{ $row->remarks }}</td>
            <td>{{ $row->is_approved == 1 ? 'Done' : 'Pending' }}</td>
            <td>@include('admin.section.buttons.button-edit') @include('admin.section.buttons.button-view')</td>
        </tr>
    @endforeach
@else
<tr>
<td colspan="10">कुनै डाटा फेला परेन</td>
</tr>
</tbody>
@endif
