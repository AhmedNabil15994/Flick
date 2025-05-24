<div class="form-group">
    <div class="">
        <select id="status" name="status" class="form-control select2" style="padding: 1px 12px;"
        onchange="changeStatus(this,'{{$id}}')">
            @foreach (\Modules\Influencer\Enum\InvitationStatus::getConstList() as $item)
                <option value="{{ $item }}" {{$status == $item ? 'selected' : ''}}>
                    {{__("influencer::dashboard.events.datatable.invitations_statuses.$item")}}</option>
            @endforeach
        </select>
    </div>
</div>