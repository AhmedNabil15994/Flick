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
                                                            <h5>Publishing</h5>
                                                            <span style="display: block">
                                                                 <strong> Start at:</strong> {{Carbon\Carbon::parse($event->start_at)->toDateString()}}
                                                            </span>
                                                            <span>
                                                                <strong> End at:</strong> {{Carbon\Carbon::parse($event->end_at)->toDateString()}}
                                                            </span>
                                                        </div>
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
                                                            <th scope="col"><span>Video</span></th>
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
                                                                    @if($influencer->pivot->video != null)
                                                                        <a class="openModal" data-arr="{{url($influencer->pivot->video)}}"> <i class="fa fa-file-video-o"></i> @lang('influencer::dashboard.events.form.show_video')</a>
                                                                    @endif
                                                                </td>
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
@include('influencer::dashboard.events.components.videoModal')

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
    $(document).on('click','.openModal',function (){
        let src = $(this).data('arr');
        $('#videoModal video').attr('src',src);
        $('#videoModal').modal('show');
    })

    $(document).on('click','[data-dismiss="modal"]',function (){
        $('#videoModal').modal('hide');
    });
</script>
@endpush
