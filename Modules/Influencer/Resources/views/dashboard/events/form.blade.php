{!! field()->langNavTabs() !!}
<input type="hidden" name="campaign_id" value="{{ $campaign->id }}">
<div class="tab-content">
    @foreach (config('laravellocalization.supportedLocales') as $code => $lang)
        <div class="tab-pane fade in {{ $code == locale() ? 'active' : '' }}" id="first_{{ $code }}">
            {!! field()->text(
                'title[' . $code . ']',
                __('influencer::dashboard.events.form.title') . '-' . $code,
                $model->getTranslation('title', $code),
                ['data-name' => 'title.' . $code],
            ) !!}

            {!! field()->text(
                'location_desc[' . $code . ']',
                __('influencer::dashboard.events.form.location_desc') . '-' . $code,
                $model->getTranslation('location_desc', $code),
                ['data-name' => 'location_desc.' . $code],
            ) !!}

            {!! field()->textarea(
                'description[' . $code . ']',
                __('influencer::dashboard.events.form.description') . '-' . $code,
                $model->getTranslation('description', $code),
                ['data-name' => 'description.' . $code],
            ) !!}

            {!! field()->textarea(
                'coverage_message[' . $code . ']',
                __('influencer::dashboard.events.form.coverage_message') . '-' . $code,
                $model->getTranslation('coverage_message', $code),
                ['data-name' => 'coverage_message.' . $code],
            ) !!}

        </div>
    @endforeach
</div>

{!! field()->number('companions_count', __('influencer::dashboard.events.form.companions_count')) !!}

{!! field()->text('location', __('influencer::dashboard.events.form.location')) !!}

{!! field()->datetime(
    'start_at',
    __('influencer::dashboard.events.form.start_at'),
    optional($model->start_at)->format('Y-m-d\TH:i'),
) !!}

{!! field()->datetime(
    'end_at',
    __('influencer::dashboard.events.form.end_at'),
    optional($model->end_at)->format('Y-m-d\TH:i'),
) !!}


{{-- {!! field()->multiSelect(
    'influencers',
    __('influencer::dashboard.events.form.influencers'),
    $model->influencers ? $model->influencers->pluck('name', 'id')->toArray() : [],
    null,
    [
        'class' => 'form-control select2-ajex ignore-reset',
    ],
) !!} --}}

<div class="form-group">
    <label class="col-md-2">
        {{ __('influencer::dashboard.events.form.helper_links') }}
    </label>
    <div class="col-md-9">
        @if ($model->helper_links)
            @foreach ($model->helper_links as $index => $helperLink)
                <div class="container-link-group">

                    <div class="container-links">
                        <div class="row">
                            <div class="col-md-3">
                                <input class="form-control" type="text" name="helper_links[{{ $index }}][key]"
                                    data-name="helper_links.{{ $index }}.key"
                                    value="{{ isset($helperLink) ? $helperLink['key'] : '' }}" placeholder="key">
                                <div class="form-group">
                                    <div class="help-block"></div>
                                </div>

                            </div>
                            <div class="col-md-8">
                                <input class="form-control" type="text"
                                    value="{{ isset($helperLink) ? $helperLink['link'] : '' }}"
                                    name="helper_links[{{ $index }}][link]"
                                    data-name="helper_links.{{ $index }}.link" placeholder="link">
                                <div class="form-group">
                                    <div class="help-block"></div>
                                </div>

                            </div>
                            @if ($index != 0)
                                <div class="col-md-1">
                                    <button class="btn btn-block btn-danger  btn-delete">X</button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="btn-add-container">
                <button class="btn btn-block btn-lg  btn-primary btn-add">@lang('apps::dashboard.buttons.add_new')</button>
            </div>
        @else
            <div class="container-link-group">
                <div class="container-links">
                    <div class="row">
                        <div class="col-md-3 ">

                            <input class="form-control" type="text" name="helper_links[0][key]"
                                data-name="helper_links.0.key" placeholder="key">
                            <div class="form-group">
                                <div class="help-block"></div>
                            </div>


                        </div>
                        <div class="col-md-8 form-group">

                            <input class="form-control" type="text" name="helper_links[0][link]"
                                data-name="helper_links.0.link" placeholder="link">
                            <div class="form-group">
                                <div class="help-block"></div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <div class="btn-add-container">
                <button class="btn btn-block btn-lg  btn-success btn-add">@lang('apps::dashboard.buttons.add_new')</button>
            </div>

        @endif
    </div>
</div>


{{-- @if ($model->trashed())
    {!! field()->checkBox('trash_restore', __('apps::dashboard.datatable.form.restore')) !!}
@endif --}}


@push('scripts')
    <script>
        $(document).ready(function() {

            // $(".select2-ajex").select2({
            //     ajax: {
            //         url: "{{ route('dashboard.influencers.show.influencers_options') }}",
            //         data: function(params) {
            //             var query = {
            //                 search: params.term,
            //                 page: params.page || 1
            //             }

            //             // Query parameters will be ?search=[term]&type=public
            //             return query;
            //         },
            //         processResults: function(data, params) {
            //             params.page = params.page || 1;

            //             var results = data.data.map(function(object) {
            //                 return {
            //                     id: object.id,
            //                     text: object.name
            //                 }
            //             })
            //             // Transforms the top-level key of the response object from 'items' to 'results'
            //             return {
            //                 results: results,
            //                 pagination: {
            //                     more: data.next_page_url ? true : false
            //                 }
            //             };
            //         }
            //     }
            // });

            // handler heleper button
            var containerLink = $(".container-links")
            var btnContinerLink = $(".btn-add-container")
            var btnAddLink = $(".btn-add")
            var linkGroup = $(".container-link-group")
            var btnDelete = $(".btn-delete")
            var containerLinkLength = containerLink.length
            var btnLinkTemplate = `
            <div class="container-links">
                <div class="row">
                    <div class="col-md-3 form-group">
                        <input class="form-control" type="text" name="helper_links[:index][key]"
                            data-name="helper_links.:index.key" placeholder="key">
                        <div class="form-group">
                              <div class="help-block"></div>
                         </div>
                    </div>
                    <div class="col-md-8 form-group">
                        <input class="form-control" type="text" name="helper_links[:index][link]"
                            data-name="helper_links.:index.link" placeholder="link">
                        <div class="form-group">
                              <div class="help-block"></div>
                         </div>

                    </div>
                    <div class="col-md-1">
                                    <button class="btn btn-block btn-danger btn-delete">X</button>
                    </div>

                </div>
            </div>
            `

            function handerBtnAddLink() {
                if ($(".container-links").length < 5) {
                    containerLinkLength++
                    linkGroup.append(btnLinkTemplate.replaceAll(":index", containerLinkLength == 1 ? 1 :
                        containerLinkLength - 1))
                }
                $(".container-links").length == 5 && btnAddLink.hide()

            }

            function handerDeleteLink(event) {
                event.preventDefault();
                $(this).parents(".container-links").remove()
                if ($(".container-links").length < 5) {
                    btnAddLink.show()
                }

            }

            // event click add new 
            $("body").on("click", ".btn-add", function(event) {
                event.preventDefault();
                handerBtnAddLink()
            })

            $("body").on("click", ".btn-delete", handerDeleteLink)

        });
    </script>
@endpush
