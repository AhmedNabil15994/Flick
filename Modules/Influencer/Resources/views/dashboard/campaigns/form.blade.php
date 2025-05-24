{!! field()->langNavTabs() !!}

<div class="tab-content">
    @foreach (config('laravellocalization.supportedLocales') as $code => $lang)
        <div class="tab-pane fade in {{ $code == locale() ? 'active' : '' }}" id="first_{{ $code }}">
            {!! field()->text(
                'title[' . $code . ']',
                __('influencer::dashboard.campaigns.form.title') . '-' . $code,
                $model->getTranslation('title', $code),
                ['data-name' => 'title.' . $code],
            ) !!}

            {!! field()->textarea(
                'description[' . $code . ']',
                __('influencer::dashboard.campaigns.form.description') . '-' . $code,
                $model->getTranslation('description', $code),
                ['data-name' => 'description.' . $code],
            ) !!}

        </div>
    @endforeach
</div>

{!! field()->file(
    'cover',
    __('influencer::dashboard.campaigns.form.cover'),
    $model->cover ? url($model->cover) : null,
) !!}

{!! field()->date(
    'start_at',
    __('influencer::dashboard.campaigns.form.start_at'),
) !!}

{!! field()->date(
    'end_at',
    __('influencer::dashboard.campaigns.form.end_at'),
) !!}

{!! field()->checkBox('is_active', __('influencer::dashboard.campaigns.form.is_active')) !!}
{!! field()->select(
    'status',
    __('influencer::dashboard.campaigns.form.status'),
    \Modules\Influencer\Enum\CampaignInfluencerStatus::renderSelectedOptions(),
    $model->status ?? \Modules\Influencer\Enum\CampaignInfluencerStatus::WAITING,
) !!}

{!! field()->select(
    'company_id',
    __('influencer::dashboard.campaigns.form.company_id'),
    $model->company_id ? [$model->company_id => optional($model->company)->name] : [],
    $model->company_id,
    [
        'class' => 'form-control select2-ajex',
    ],
) !!}



@if ($model->trashed())
    {!! field()->checkBox('trash_restore', __('apps::dashboard.datatable.form.restore')) !!}
@endif


@push('scripts')
    <script>
        $(document).ready(function() {

            $(".select2-ajex").select2({
                ajax: {
                    url: "{{ route('dashboard.companies.show.select_options') }}",
                    data: function(params) {
                        var query = {
                            search: params.term,
                            page: params.page || 1
                        }

                        // Query parameters will be ?search=[term]&type=public
                        return query;
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;

                        var results = data.data.map(function(object) {
                            return {
                                id: object.id,
                                text: object.name
                            }
                        })
                        // Transforms the top-level key of the response object from 'items' to 'results'
                        return {
                            results: results,
                            pagination: {
                                more: data.next_page_url ? true : false
                            }
                        };
                    }
                }
            });

            //

        });
    </script>
@endpush
