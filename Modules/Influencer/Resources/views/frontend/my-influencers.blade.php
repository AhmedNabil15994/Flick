@extends('apps::frontend.layouts.app')
@section('css')
<style>
    .hidden{display: none !important;}
    span.static-box{font-size: 15px !important;}
</style>
@endsection
@section('content')
    @inject('constants', 'Modules\Influencer\Entities\Constant\Constants')
    @php
        $STAUTS_IN_LISTS = $constants::STAUTS_IN_LISTS;
    @endphp



    <div class="wrapper">
        <div class='my-influnecers bg-light'>
            <div class='row'>
                <div class='col-md-2'>
                    <div class='influ-list'>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @foreach($list->events as $listKey => $listValue)
                                <li>
                                    <a href="{{ route('clients.getList',['event_id' => hash_id($listValue->id),'campaign_id'=>hash_id($list->id)]) }}" 
                                        class="{{(isset($id) && $listKey == 0 ) || (isset($event) && $event->id == $listValue->id) ? 'active' : ''}} text-center" id="home-tab{{$listKey}}">
                                        {{$listValue->title}}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class='col-md-10'>
                    <div class='my-infu-statics tab-content' id="myTabContent">
                        {{-- @foreach($list->events as $listKey => $listValue) --}}
                        @if($event)
                            <div class="tab-pane fade  show active" id="home{{$event->id}}" role="tabpanel" aria-labelledby="home-tab{{$event->id}}">
                                <div class="influ-statics ">
                                    <div class="statics-details">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="a-tab" data-bs-toggle="tab" data-bs-target="#tab-4" type="button" role="tab" aria-controls="tab-4" aria-selected="true"><ion-icon name="logo-instagram"></ion-icon> <span>Instagram</span></button>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab-4" role="tabpanel" aria-labelledby="a-tab">
                                                @if(count($event->influencers))
                                                    <div class="stcs-summery bg-light">
                                                        <div class='item'>
                                                            <h5>Followers</h5>
                                                            <p>{{$followers}}</p>
                                                        </div>
                                                        <div class='item'>
                                                            <h5>Avg. engagement</h5>
                                                            <span class="static-box">{{$engagements}}%</span>
                                                        </div>
                                                        <div class='item'>
                                                            <h5>Avg. Quality Score</h5>
                                                            <span class="static-box bg-1">{{$quality_scores}}</span>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="table-responsive">
                                                    <table>
                                                        <thead class="bg-light">
                                                        <tr>
                                                            <th scope="col"><span>Account Name</span></th>
                                                            <th scope="col"><span>Followers</span></th>
                                                            <th scope="col"><span>Engagement</span></th>
                                                            <th scope="col"><span>Quality Score</span></th>
                                                            <th scope="col"><span>Status</span></th>
                                                            <th scope="col"><span>Actions</span></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($event->influencers as $influencer)
                                                            <tr>
                                                                <td>
                                                                    <div class="d-flex cursor-pointer" data-bs-toggle="modal" data-bs-target="#influncer-details">
                                                                        <a href="{{$influencer->website_url ?? '#'}}">

                                                                        <div class="img-block">
                                                                            <img class="img-fluid" src="{{ asset($influencer->image)}}" alt="">
                                                                        </div>
                                                                        <div class="item-info">
                                                                            <h3 class="username">{{$influencer->name}}</h3>
                                                                            <p class="userlocation"><ion-icon name="location-outline" role="img" class="md hydrated" aria-label="location outline"></ion-icon> Kuwait</p>
                                                                        </div>
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                                <td>{{$influencer->instagrams()->sum('followers')}}</td>
                                                                <td><span class="static-box">{{$influencer->instagrams()->sum('engagements')}}%</span></td>
                                                                <td><span class="static-box bg-1">{{$influencer->instagrams()->sum('quality_score')}}%</span></td>
                                                                <td>
                                                                    <span class="static-box">{{$influencer->pivot->status}}</span>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch">
                                                                        <input class="form-check-input updateStatus" onchange="updateInfluencerStatus(this)" data-area="{{$influencer->pivot->id}}" {{$influencer->pivot->invitation_status == 1 ? 'checked' : ''}} type="checkbox">
                                                                    </div>
                                                                   
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-danger" role="alert">
                                @lang("No Event Found")
                            </div>
                        @endif
                        {{-- @endforeach --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@stop
@push('frontend_scripts')
<script>
    function updateInfluencerStatus(iput){
        let invitation_id = $(iput).data('area');
        let status = $(iput).is(':checked');
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
        $.ajax({
            type: 'POST',
            url: '/updateInvitationStatus/'+invitation_id,
            data:{
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'status': status,
            },
            success:function(data){
                successNotification(data);
            },
        });
    }
</script>
@endpush