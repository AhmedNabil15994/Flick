<div class="item-block">
    <div class="item-head d-flex justify-content-between">
        <div class="influ-social">
            @foreach ($influencer->socials as $name => $url)
                @if ($url)     
                    <a href="{{$url}}"><img class="img-fluid" src="{{asset("/frontend")}}/images/{{$name}}.svg" alt=""/></a>
                @endif
            @endforeach
        </div>
        <a class="img-block cursor-pointer" href="#">
            <img class="img-fluid" src="{{asset($influencer->image)}}" alt="" />
        </a>
            <div class="item-opt">
                <button class="addToList add-details dropdown-toggle" id="800" data-bs-toggle="dropdown" aria-expanded="false"> <ion-icon name="duplicate-outline"></ion-icon> <span>@lang("Add to campaign")</span></button>
                <div class="dropdown-menu note-form" style="overflow: auto;max-height: 275px;" aria-labelledby="800">

                    @if(count($campaigns))
                        <form action="{{route("clients.updateInfluencerEvents",$influencer->id)}}">
                            @csrf
                            @foreach ($campaigns as $campaign)
                                @if (count($campaign['events']))
                                    <h4>{{$campaign['title']}}</h4>
                                    @foreach ($campaign['events'] as $event)
                                        <div class="form-check form-group">
                                            <input class="form-check-input" type="checkbox" onchange="saveinfluencercampaigns(this)" name="events[]"
                                            {{in_array($influencer->id,$event['influencers_ids']) ? 'checked' : ''}}
                                            value="{{$event['id']}}" id="flexCheckDefault-{{$influencer->id}}-{{$event['id']}}">
                                            <label class="form-check-label" for="flexCheckDefault-{{$influencer->id}}-{{$event['id']}}">
                                                {{$event['title']}}
                                            </label>
                                        </div>
                                    @endforeach
                                @endif
                            @endforeach
                        </form>
                    @else
                        <h4>
                            @lang("Not have any campaigns")
                        </h4>
                    @endif
                </div>
            </div>
    </div>
    <a class="item-info text-center cursor-pointer" href="#">
        <h3 class="username"><span class="symbol">@</span> {{$influencer->name}}</h3>
        <p class="userlocation"><i class="fas fa-map-marker-alt"></i> {{ optional($influencer->country)->title}}</p>
    </a> 
    <a class="block-flo text-center" href="#">
        @if ($influencer->tags()->count())
            <div class="tags">
                @foreach ($influencer->tags()->get() as $tag)
                    
                    <span>{{$tag->title}}</span>

                @endforeach
            </div>
        @endif

        @php
            $influencerSocialInfo = optional(optional($influencer->$social())->latest()->first());
        @endphp
        <div class="user-followers d-flex justify-content-between">
            @if ($influencerSocialInfo->followers != null || $influencerSocialInfo->posts_count == 0)
                <h5 class="followers-num"><span>@lang("Followers")</span> <b>{{formatNumberToK($influencerSocialInfo->followers)}}</b> </h5>
            @endif
            @if ($influencerSocialInfo->posts_count != null || $influencerSocialInfo->posts_count == 0)
                <h5 class="followers-num"><span>@lang("Posts")</span> <b>{{formatNumberToK($influencerSocialInfo->posts_count)}}</b> </h5>
            @endif
            @if ($influencerSocialInfo->engagements != null || $influencerSocialInfo->posts_count == 0)
                <h5 class="followers-num"><span>@lang("Engagement")</span> <b>{{$influencerSocialInfo->engagements}}</b> </h5>
            @endif
        </div>  
    </a>
</div>