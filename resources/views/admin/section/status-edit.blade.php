<div class="col-md-3">
    <div class="form-group">
        <label for="status">Status</label>
        <div class="form-group">
            <label class="ui-checkbox">
                <!-- Hidden input for default value -->
                <input type="hidden" name="status" value="0">
                <input 
                    style="scale: 1.6;" 
                    type="checkbox" 
                    name="status" 
                    value="1" 
                    @if($data['row']->status) checked @endif
                >
                <span class="input-span"></span>
            </label>
        </div>
    </div>
</div>
