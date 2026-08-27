<input type="password" autocomplete="new-password"
    {{ $attributes->class(['form-control'])->merge([
            'placeholder' => __('Mật khẩu'),
        ])->merge($isRequired()) }}>
