{!! field()->langNavTabs() !!}

<div class="tab-content">
    @foreach (config('laravellocalization.supportedLocales') as $code => $lang)
        <div class="tab-pane fade in {{ $code == locale() ? 'active' : '' }}" id="first_{{ $code }}">
            {!! field()->text(
                'name[' . $code . ']',
                __('influencer::dashboard.influencer_tiktok.form.name') . '-' . $code,
                $model->getTranslation('name', $code),
                ['data-name' => 'name.' . $code],
            ) !!}

            {!! field()->textarea(
                'bio[' . $code . ']',
                __('influencer::dashboard.influencer_tiktok.form.bio') . '-' . $code,
                $model->getTranslation('bio', $code),
                ['data-name' => 'bio.' . $code],
            ) !!}

        </div>
    @endforeach
</div>
{!! field()->select(
    'country_id',
    __('influencer::dashboard.influencer_tiktok.form.country_id'),
    $countries->pluck('title', 'id')->toArray(),
) !!}
{!! field()->file(
    'image',
    __('influencer::dashboard.influencer_tiktok.form.image'),
    $model->image ? url($model->image) : null,
) !!}
{!! field()->email('email', __('influencer::dashboard.influencer_tiktok.form.email')) !!}
{!! field()->password('password', __('user::dashboard.users.form.password'), ['autocomplete' => 'off']) !!}
{!! field()->password('password_confirmation', __('user::dashboard.users.form.confirm_password')) !!}
{!! field()->text('contact_number', __('influencer::dashboard.influencer_tiktok.form.contact_number')) !!}
{!! field()->text('website_url', __('influencer::dashboard.influencer_tiktok.form.website_url')) !!}
{!! field()->multiSelect(
    'tags',
    __('influencer::dashboard.influencer_tiktok.form.tags'),
    $tags->pluck('title', 'id')->toArray(),
) !!}

@foreach (\Modules\Influencer\Enum\SocialsEnum::getConstList() as $social)
    {!! field()->text(
        "socials[$social]",
        $social,
        $model->socials && isset($model->socials[$social]) ? $model->socials[$social] : '',
    ) !!}
@endforeach

{!! field()->checkBox('status', __('influencer::dashboard.influencer_tiktok.form.status')) !!}

@if ($model->trashed())
    {!! field()->checkBox('trash_restore', __('apps::dashboard.datatable.form.restore')) !!}
@endif

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#email:not([value]').each(function() {
                $(this).attr('readonly', 'true').attr('onClick', "this.removeAttribute('readonly');");


            });
        });
    </script>
@endpush
