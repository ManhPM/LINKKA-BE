<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('Thông tin Admin') }}</h2>
        </div>
        <div class="row card-body">
            <!-- Email Address -->
            <div class="col-md-6 col-sm-12">
                <div class="mb-3">
                    <x-label for="email" text="{{ __('Email') }}" icon="ti ti-mail" required="true" />
                    <x-input-email name="email" :value="$admin->email" :required="true" />
                </div>
            </div>
            <!-- Fullname -->
            <div class="col-md-6 col-sm-12">
                <div class="mb-3">
                    <x-label for="fullname" text="{{ __('Họ và tên') }}" icon="ti ti-user-edit" required="true" />
                    <x-input name="fullname" :value="$admin->fullname" :required="true" placeholder="{{ __('Họ và tên') }}" />
                </div>
            </div>
            <!-- new password -->
            <div class="col-md-6 col-sm-12">
                <div class="mb-3">
                    <x-label for="password" text="{{ __('Mật khẩu') }}" icon="ti ti-square-key" />
                    <x-input-password name="password" />
                </div>
            </div>
            <!-- new password confirmation-->
            <div class="col-md-6 col-sm-12">
                <div class="mb-3">
                    <x-label for="password_confirmation" text="{{ __('Xác nhận mật khẩu') }}" icon="ti ti-square-key" />
                    <x-input-password name="password_confirmation" data-parsley-equalto="input[name='password']"
                        data-parsley-equalto-message="{{ __('Mật khẩu không khớp.') }}" />
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="mb-3">
                    <x-label for="phone" text="{{ __('Số điện thoại') }}" icon="ti ti-phone" required="true" />
                    <x-input-phone name="phone" :value="$admin->phone" :required="true" />
                </div>
            </div>
        </div>

        <!-- permissions -->
        <div class="row card-body">
            <div class="col-12">
                <div class="mb-3">
                    <x-label text="{{ __('Vai trò') }}" icon="ti ti-user-check" />
                    <div class="row">
                        @foreach ($roles as $role)
                            <div class="col-4">
                                <input type="checkbox" name="roles[]" value="{{ $role->name }}"
                                    data-role-name="{{ $role->name }}" data-role-title="{{ $role->title }}"
                                    {{ $admin->roles->contains($role->id) ? 'checked' : '' }}> {{ $role->title }}<br>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>

        <!-- Branch extra fields (shown when selecting Chi nhánh role) -->
        <div class="row card-body" id="branch-fields" style="display:none;">
            <div class="col-md-6 col-sm-12">
                <div class="mb-3">
                    <x-label for="branch_name" text="{{ __('Tên chi nhánh') }}" icon="ti ti-building-store"
                        required="true" />
                    <x-input name="branch_name" :value="old('branch_name', $admin->branch_name ?? null)" :required="true"
                        placeholder="{{ __('Tên chi nhánh') }}" />
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="mb-3">
                    <x-label for="branch_phone" text="{{ __('Số điện thoại chi nhánh') }}" icon="ti ti-phone"
                        required="true" />
                    <x-input-phone name="branch_phone" :value="old('branch_phone', $admin->branch_phone ?? null)" :required="true" />
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <x-label for="branch_address" text="{{ __('Địa chỉ chi nhánh') }}" icon="ti ti-map-pin"
                        required="true" />
                    <x-input name="branch_address" :value="old('branch_address', $admin->branch_address ?? null)" :required="true"
                        placeholder="{{ __('Địa chỉ chi nhánh') }}" />
                </div>
            </div>
        </div>

        <script>
            (function() {
                function isBranchRoleCheckbox(checkbox) {
                    var name = (checkbox.getAttribute('data-role-name') || '').toLowerCase();
                    var title = (checkbox.getAttribute('data-role-title') || '').toLowerCase();
                    return name === 'branch' || name === 'store' || title.includes('chi nhánh');
                }

                function updateBranchFieldsVisibility() {
                    var checkboxes = document.querySelectorAll("input[name='roles[]']");
                    var shouldShow = false;
                    checkboxes.forEach(function(cb) {
                        if (isBranchRoleCheckbox(cb) && cb.checked) {
                            shouldShow = true;
                        }
                    });
                    var section = document.getElementById('branch-fields');
                    if (!section) return;
                    section.style.display = shouldShow ? '' : 'none';

                    var inputs = section.querySelectorAll('input, select, textarea');
                    inputs.forEach(function(input) {
                        if (shouldShow) {
                            input.disabled = false;
                            if (input.getAttribute('data-was-required') === 'true') {
                                input.setAttribute('required', 'required');
                                input.required = true;
                            }
                        } else {
                            if (input.hasAttribute('required') || input.required) {
                                input.setAttribute('data-was-required', 'true');
                                input.removeAttribute('required');
                                input.required = false;
                            }
                            input.disabled = true;
                        }
                    });
                }

                document.addEventListener('change', function(e) {
                    if (e.target && e.target.matches("input[name='roles[]']")) {
                        updateBranchFieldsVisibility();
                    }
                });

                document.addEventListener('DOMContentLoaded', function() {
                    updateBranchFieldsVisibility();
                });
                updateBranchFieldsVisibility();
            })();
        </script>

    </div>
</div>
