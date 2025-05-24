@push('styles')
    <style>
        .select2-container {
            width: 100% !important;
        }
    </style>
@endpush
{!! field()->langNavTabs() !!}

<div class="tab-content">
    @foreach (config('laravellocalization.supportedLocales') as $code => $lang)
        <div class="tab-pane fade in {{ $code == locale() ? 'active' : '' }}" id="first_{{ $code }}">
            {!! field()->text(
                'name[' . $code . ']',
                __('company::dashboard.companies.form.name') . '-' . $code,
                $model->getTranslation('name', $code),
                ['data-name' => 'name.' . $code],
            ) !!}

            {!! field()->textarea(
                'description[' . $code . ']',
                __('company::dashboard.companies.form.description') . '-' . $code,
                $model->getTranslation('description', $code),
                ['data-name' => 'description.' . $code],
            ) !!}

        </div>
    @endforeach
</div>

{!! field()->select(
    'manager_id',
    __('company::dashboard.companies.form.manager_id'),
    $model->manager_id ? [$model->manager->id => optional($model->manager)->name] : [],
    $model->manager_id ,
    [
        'class' => 'form-control select2-ajex-influencers ignore-reset',
    ],
) !!}


{!! field()->multiSelect(
    'workers',
    __('influencer::dashboard.instagram.form.workers'),
    $model->workers ? $model->workers->pluck('name', 'id')->toArray() : [],
    null,
    [
        'class' => 'form-control select2-ajex ignore-reset',
    ],
) !!}

{!! field()->multiSelect(
    'tags',
    __('company::dashboard.companies.form.tags'),
    $tags->pluck('title', 'id')->toArray(),
) !!}

{!! field()->file(
    'logo',
    __('company::dashboard.companies.form.logo'),
    $model->logo ? url($model->logo) : null,
) !!}
{!! field()->email('email', __('company::dashboard.companies.form.email')) !!}



{!! field()->text('mobile', __('company::dashboard.companies.form.mobile')) !!}




{!! field()->checkBox('status', __('company::dashboard.companies.form.status')) !!}



@if ($model->trashed())
    {!! field()->checkBox('trash_restore', __('apps::dashboard.datatable.form.restore')) !!}
@endif

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#email:not([value]').each(function() {
                $(this).attr('readonly', 'true').attr('onClick', "this.removeAttribute('readonly');");


            });


            // influencers 
            $(".select2-ajex-influencers").select2({
                ajax: {
                    url: "{{ route('dashboard.users.show.select_options') }}",
                    data: function(params) {
                        var query = {
                            type : "{{\Modules\User\Enum\UserType::COMPANY_WORKER}}",
                            search: params.term,
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

            // workers
            $(".select2-ajex").select2({
                ajax: {
                    url: "{{ route('dashboard.users.show.select_options') }}",
                    data: function(params) {
                        var query = {
                            search: params.term,
                            type : "{{\Modules\User\Enum\UserType::COMPANY_WORKER}}",
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
