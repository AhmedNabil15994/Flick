{!! field()->select(
    'package_id',
    __('user::dashboard.users.show.subscriptions.package_id'),
    $packages->pluck('title', 'id')->toArray(),
    $model->package_id ?? null,
    ['disabled' => $is_update ?? false],
) !!}

@if (isset($is_update) && $is_update)
    {!! field()->datetime(
        'start_at',
        __('user::dashboard.users.show.subscriptions.start_at'),
        optional($model->start_at)->format('Y-m-d\TH:i'),
    ) !!}
    {!! field()->datetime(
        'end_at',
        __('user::dashboard.users.show.subscriptions.end_at'),
        optional($model->end_at)->format('Y-m-d\TH:i'),
    ) !!}
    {!! field()->text('price', __('user::dashboard.users.show.subscriptions.price'), $model->price ?? 0) !!}
@endif
