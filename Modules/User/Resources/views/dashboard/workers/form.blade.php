@php($model->loadMissing("roles"))
{!! field()->text('name', __('user::dashboard.workers.form.name'), $model->name) !!}
{{-- <input type="hidden" name="phone_code" value="965" /> --}}
<div class="form-group">
    <label class="col-md-2">
        {{__('user::dashboard.workers.form.mobile') }}
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
{{-- {!! field()->text('mobile', __('user::dashboard.workers.form.mobile'), $model->mobile) !!} --}}
{!! field()->email('email', __('user::dashboard.workers.form.email'), $model->email, ['autocomplete' => 'emm']) !!}
{!! field()->password('password', __('user::dashboard.workers.form.password'), ['autocomplete' => 'off']) !!}
{!! field()->password('password_confirmation', __('user::dashboard.workers.form.confirm_password')) !!}
{!! field()->select(
    'country_id',
    __('user::dashboard.workers.form.country_id'),
    $countries->pluck('title', 'id')->toArray(),
) !!}
{!! field()->select(
    'type',
    __('user::dashboard.workers.form.type'),
    \Modules\User\Enum\UserType::getWorkerTypeOptions(),
) !!}
{!! field()->file('image', __('user::dashboard.workers.form.image'), $model->image ? url($model->image) : null) !!}
{!! field()->checkBox('admin_approved', __('user::dashboard.workers.form.admin_approved'), 1) !!}
{!! field()->checkBox('is_verified', __('user::dashboard.workers.form.is_verified'), 1) !!}
{!! field()->multiSelect(
    'roles',
    __('user::dashboard.workers.form.roles'),
    $model->roles ? $model->roles->pluck('display_name', 'id')->toArray() : [],
    null,
    [
        'class' => 'form-control select2-ajex select2 ignore-reset reload.select2',
    ],
) !!}
@if ($model && $model->trashed())
    {!! field()->checkBox('trash_restore', __('apps::dashboard.datatable.form.restore')) !!}
@endif

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#email:not([value]').each(function() {
                $(this).attr('readonly', 'true').attr('onClick', "this.removeAttribute('readonly');");


            });
            // Handle roles 
            var roles = $(".select2-ajex")
            var type = $("#type")

            function handleRoles() {
                roles.prop("disabled", !type.val())
                if (!type.val()) return
                roles.select2({
                    ajax: {
                        url: "{{ route('dashboard.roles.show.options') }}",
                        data: function(params) {
                            var query = {
                                type: type.val(),
                            }

                            // Query parameters will be ?search=[term]&type=public
                            return query;
                        },
                        processResults: function(data, params) {
                                var results = data.data ? data.data.map(function(object) {
                                return {
                                    id: object.id,
                                    text: object.display_name
                                }
                            }) : []
                            // Transforms the top-level key of the response object from 'items' to 'results'
                            return {
                                results: results
                            };
                        }
                    }
                });
            }
            handleRoles()
            type.on("change", function() {
                roles.empty();
                handleRoles()
            })
        });
    </script>
@endpush
