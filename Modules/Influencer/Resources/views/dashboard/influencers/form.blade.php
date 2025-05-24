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
                __('influencer::dashboard.influencers.form.name') . '-' . $code,
                $model->getTranslation('name', $code),
                ['data-name' => 'name.' . $code],
            ) !!}

            {!! field()->textarea(
                'bio[' . $code . ']',
                __('influencer::dashboard.influencers.form.bio') . '-' . $code,
                $model->getTranslation('bio', $code),
                ['data-name' => 'bio.' . $code],
            ) !!}

        </div>
    @endforeach
</div>
{!! field()->select(
    'nationality_id',
    __('influencer::dashboard.influencers.form.nationality_id'),
    $countries->pluck('nationality', 'id')->toArray(),
) !!}
{!! field()->file(
    'image',
    __('influencer::dashboard.influencers.form.image'),
    $model->image ? url($model->image) : null,
) !!}
{!! field()->email('email', __('influencer::dashboard.influencers.form.email')) !!}
{!! field()->textarea('address_desc', __('influencer::dashboard.influencers.form.address_desc'), $model->address_desc,[
    "class"=> "form-control"
]) !!}

{!! field()->password('password', __('user::dashboard.users.form.password'), ['autocomplete' => 'off']) !!}
{!! field()->password('password_confirmation', __('user::dashboard.users.form.confirm_password')) !!}
{!! field()->date('birth_date', __('influencer::dashboard.influencers.form.birth_date')) !!}

<div class="form-group">
    <label class="col-md-2">
        {{ __('influencer::dashboard.influencers.form.mobile') }}
    </label>
    <div class="col-md-3">
        <select name="phone_code" class="form-control select2" data-name="phone_code" required>
            <option value=""></option>
            @foreach (supportedPhoneCodes() as $phoneCode)
                @if (!empty($phoneCode['calling_code'][0]))
                    <option value="{{ $phoneCode['calling_code'][0] }}"
                        @if ($model->phone_code == $phoneCode['calling_code'][0] || $phoneCode['calling_code'][0] == '965') selected @endif>
                        {{ $phoneCode['flag'] . ' ' . $phoneCode['code'] . ' +' . $phoneCode['calling_code'][0] }}
                    </option>
                @endif
            @endforeach
        </select>
        <div class="help-block"></div>
    </div>
    <div class="col-md-6">
        <input type="text" name="mobile" value="{{ $model->mobile }}" class="form-control" data-name="mobile">
        <div class="help-block"></div>
    </div>
</div>

<div class="form-group">
    <label class="col-md-2">
        {{ __('influencer::dashboard.influencers.form.gender') }}
    </label>
    <div class="col-md-9">
        @foreach (\Modules\Influencer\Enum\GenderType::getConstList() as $gender)
            <label>@lang("influencer::dashboard.influencers.form.genders.$gender")</label>
            <input type="radio" value="{{ $gender }}" {{ $gender == $model->gender ? 'checked' : '' }}
                data-name="gender" data-size="small" name="gender">
        @endforeach
        <div class="help-block"></div>
    </div>
</div>

{!! field()->text('website_url', __('influencer::dashboard.influencers.form.website_url')) !!}
{!! field()->multiSelect(
    'tags',
    __('influencer::dashboard.influencers.form.tags'),
    $tags->pluck('title', 'id')->toArray(),
) !!}

@foreach (\Modules\Influencer\Enum\SocialsEnum::getConstList() as $social)
    {!! field()->text(
        "socials[$social]",
        $social,
        $model->socials && isset($model->socials[$social]) ? $model->socials[$social] : '',
    ) !!}
@endforeach

{!! field()->checkBox('status', __('influencer::dashboard.influencers.form.status')) !!}



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
