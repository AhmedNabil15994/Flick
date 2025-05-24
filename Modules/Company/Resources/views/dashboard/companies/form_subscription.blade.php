{!! field()->select(
    'package_id',
__('company::dashboard.companies.show.subscriptions.package_id'),
    $packages->pluck('title', 'id')->toArray(),
    $model->package_id ?? null,
    ['disabled' => $is_update ?? false],
) !!}


@if (isset($is_update) && $is_update)
    {!! field()->datetime(
        'start_at',
        __('company::dashboard.companies.show.subscriptions.start_at'),
        optional($model->start_at)->format('Y-m-d\TH:i'),
    ) !!}
    {!! field()->datetime(
        'end_at',
        __('company::dashboard.companies.show.subscriptions.end_at'),
        optional($model->end_at)->format('Y-m-d\TH:i'),
    ) !!}
    {!! field()->text('price', __('company::dashboard.companies.show.subscriptions.price'), $model->price ?? 0) !!}

    {!! field()->number('number_of_influencers', __('company::dashboard.companies.show.subscriptions.number_of_influencers'), $model->number_of_influencers ?? 0) !!}
    {!! field()->number('using_count', __('company::dashboard.companies.show.subscriptions.using_count'), $model->using_count ?? 0) !!}

@endif

{!! field()->textarea(
    "comment",
    __('company::dashboard.companies.show.subscriptions.comment'),
    $model->comment ,
    [
        "class"=> "form-control"
    ]

)
!!}