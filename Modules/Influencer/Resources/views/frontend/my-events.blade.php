@extends('apps::frontend.layouts.app')
<style>
    .hidden{display: none !important;}
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
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @foreach($list->events as $key => $value)
                                <li>
                                    <a href="{{ route('clients.getList',['event_id' => hash_id($value->id),'campaign_id'=>hash_id($list->id)]) }}" class="{{isset($id) && $key == 0 ? 'active' : ''}} text-center" id="home-tab{{$value}}">
                                        {{$value->title}}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class='col-md-10'>
                    <div class='my-infu-statics tab-content' id="myTabContent">

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@stop
