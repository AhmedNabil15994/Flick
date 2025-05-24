{!! field()->select(
    'influencer_id',
    __('influencer::dashboard.tiktok.form.influencer_id'),
    $model->influencer_id ? [$model->influencer->id => optional($model->influencer)->name] : [],
    $model->influencer_id ,
    [
        'class' => 'form-control select2 select2-ajex-influencers ',
    ],
) !!}

{!! field()->multiSelect(
    'workers',
    __('influencer::dashboard.tiktok.form.workers'),
    $model->workers ? $model->workers->pluck('name', 'id')->toArray() : [],
    null,
    [
        'class' => 'form-control select2-ajex ignore-reset',
    ],
) !!}
{!! field()->text('user_name', __('influencer::dashboard.tiktok.form.user_name')) !!}
{!! field()->text('account_id', __('influencer::dashboard.tiktok.form.account_id')) !!}
{!! field()->text('url', __('influencer::dashboard.tiktok.form.url')) !!}



{!! field()->checkBox('status', __('influencer::dashboard.tiktok.form.status')) !!}


@push('scripts')
    <script>
        $(document).ready(function() {

            // influencers 
            $(".select2-ajex-influencers").select2({
                ajax: {
                    url: "{{ route('dashboard.influencers.show.influencers_options') }}",
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
                                more: data.links.next ? true : false
                            }
                        };
                    }
                }
            });

            // workers
            $(".select2-ajex").select2({
                ajax: {
                    url: "{{ route('dashboard.users.show.select_options') }}",
                    data: function(params) {
                        var query = {
                            search: params.term,
                            type : "{{\Modules\User\Enum\UserType::INFLUENCER_WORKER}}",
                            page: params.page || 1
                        }

                        // Query parameters will be ?search=[term]&type=public
                        return query;
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;

                        // Transforms the top-level key of the response object from 'items' to 'results'
                        return {
                            results: data.data,
                            pagination: {
                                more: data.next_page_url ? true : false
                            }
                        };
                    }
                }
            });
        });
    </script>
@endpush
