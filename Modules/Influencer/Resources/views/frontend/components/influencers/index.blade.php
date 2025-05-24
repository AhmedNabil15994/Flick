<div class="row">
    @if (count($influencers))
        
        @foreach ($influencers as $influencer)
            <div class="col-md-4 col-12">
                    @include("influencer::frontend.components.influencers.single-card",['influencer' => $influencer])
            </div>
        @endforeach

    @else
        <div class="alert alert-danger text-center" role="alert">
            @lang("No influencers found")
        </div>
    @endif
    
</div>

@include("influencer::frontend.components.influencers.paginator",['paginator' => $influencers])