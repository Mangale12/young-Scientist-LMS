<select name="teacher_id" id="teacher_id" class="select-two">
    <option selected disabled>Assign Teacher</option>
    @foreach($teachers as $teacher)
        <option value="{{$teacher->id}}">{{$teacher->id}}</option>
    @endforeach
</select><i class="fas fa-list"></i>