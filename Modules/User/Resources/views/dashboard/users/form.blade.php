
{!! field()->text('name', __('user::dashboard.users.form.name'), $model->name )!!}
{{-- <input type="hidden" name="phone_code" value="965" /> --}}
<div class="form-group">
    <label class="col-md-2">
        {{__('user::dashboard.users.form.mobile') }}
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
{{-- {!! field()->text('mobile', __('user::dashboard.users.form.mobile'), $model->mobile )!!} --}}
{!! field()->email('email', __('user::dashboard.users.form.email'), $model->email  , ["autocomplete"=> "emm"])!!}
{!! field()->password('password', __('user::dashboard.users.form.password') , ["autocomplete"=> "off"] )!!}
{!! field()->password('password_confirmation', __('user::dashboard.users.form.confirm_password'))!!}
{!! field()->select('country_id', __('user::dashboard.users.form.country_id'),$countries->pluck('title','id')->toArray()) !!}
{!! field()->file('image',  __('user::dashboard.users.form.image') , $model->image ? url($model->image) : null  )!!}
{!! field()->checkBox('admin_approved', __('user::dashboard.users.form.admin_approved'), 1 ) !!}
{!! field()->checkBox('is_verified', __('user::dashboard.users.form.is_verified'), 1) !!}

@if($model && $model->trashed())
    {!! field()->checkBox('trash_restore',  __('apps::dashboard.datatable.form.restore') ) !!}
@endif

@push("scripts")
    <script>
        $(document).ready(function() { 
                $('#email:not([value]').each( function() { 
                        $(this).attr('readonly', 'true').attr('onClick', "this.removeAttribute('readonly');"); 

                 
                });
        }); 
    </script>
@endpush