

  @php $colorClasses = ['green','red','blue','yellow-lemon','yellow-casablanca']; @endphp
@foreach(\Modules\Influencer\Enum\InvitationStatus::getConstList() as $status)
  <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12" style="margin-top: 10px">
    <a class="dashboard-stat dashboard-stat-v2 {{$colorClasses[count(\Modules\Influencer\Enum\InvitationStatus::getConstList()) - ($loop->index + 1)]}}" href="#">
      <div class="visual">
      </div>
      <div class="details">
        <div class="number">
          <span data-counter="counterup" data-value="{{$model->invitations()->where('status',$status)->count()}}">{{$model->invitations()->where('status',$status)->count()}}</span>
        </div>
        <div class="desc">{{__("influencer::dashboard.events.datatable.invitations_statuses.$status")}}</div>
      </div>
    </a>
  </div>
@endforeach
<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12" style="margin-top: 10px">
  <a class="dashboard-stat dashboard-stat-v2 green" href="#">
    <div class="visual">
    </div>
    <div class="details">
      <div class="number">
        <span data-counter="counterup" data-value="{{$model->invitations()->where('invitation_status',1)->count()}}">{{$model->invitations()->where('invitation_status',1)->count()}}</span>
      </div>
      <div class="desc">@lang("Invite status Selected")</div>
    </div>
  </a>
</div>
<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12" style="margin-top: 10px">
  <a class="dashboard-stat dashboard-stat-v2 red" href="#">
    <div class="visual">
    </div>
    <div class="details">
      <div class="number">
        <span data-counter="counterup" data-value="{{$model->invitations()->where('invitation_status',0)->count()}}">{{$model->invitations()->where('invitation_status',0)->count()}}</span>
      </div>
      <div class="desc">@lang("Invite status Not Selected")</div>
    </div>
  </a>
</div>