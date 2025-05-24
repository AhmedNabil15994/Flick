@extends('apps::frontend.layouts.app')
<style>
    .hidden{display: none !important;}
    a.openModal{
        text-decoration: none;
        cursor: pointer;
    }
</style>
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

                        @php $campCounter = 0 @endphp
                        @foreach($lists as $listKey => $listValue)

                            @if ($campCounter == 0 && !$list && $directCall)
                                @php $list = $listValue; @endphp
                            @endif

                            <h6>{{$listValue->title}}</h6>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">

                                @php $eventsLoopCounter = 0 @endphp

                                @foreach($listValue->events as $value)

                                    @if ($eventsLoopCounter == 0 && !$event && $directCall)
                                        @php $event = $value; @endphp
                                    @endif

                                    <li>
                                        <a href="{{ route('clients.getList',['event_id' => hash_id($value->id),'campaign_id'=>hash_id($listValue->id)]) }}" class="{{$event && $event->id == $value->id ? 'active' : ''}} text-center" id="home-tab{{$value->id}}">
                                            {{$value->title}}
                                        </a>
                                    </li>

                                    @php $eventsLoopCounter++ @endphp
                                @endforeach
                            </ul>

                            @php $campCounter++ @endphp
                        @endforeach
                    </div>
                </div>

                <div class='col-md-10'>
                    <div class='my-infu-statics tab-content' id="myTabContent">
                        @if($event)
                            {!! (new \Modules\Influencer\Http\Controllers\Frontend\ClientController)->renderEventContent(hash_id($event->id)) !!}
                        @else
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@stop
