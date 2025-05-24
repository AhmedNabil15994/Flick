{!! field()->langNavTabs() !!}

<div class="tab-content">
    @foreach (config('laravellocalization.supportedLocales') as $code => $lang)
        <div class="tab-pane fade in {{ $code == locale() ? 'active' : '' }}" id="first_{{ $code }}">
            {!! field()->text(
                'title[' . $code . ']',
                __('influencer::dashboard.tags.form.title') . '-' . $code,
                $model->getTranslation('title', $code),
                ['data-name' => 'title.' . $code],
            ) !!}

            {!! field()->textarea(
                'description[' . $code . ']',
                __('influencer::dashboard.tags.form.description') . '-' . $code,
                $model->getTranslation('description', $code),
                ['data-name' => 'description.' . $code],
            ) !!}

        </div>
    @endforeach
</div>


{!! field()->checkBox('status', __('influencer::dashboard.tags.form.status')) !!}

@if ($model->trashed())
    {!! field()->checkBox('trash_restore', __('apps::dashboard.datatable.form.restore')) !!}
@endif
