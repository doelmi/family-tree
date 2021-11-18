<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Isian :attribute harus diterima.',
    'active_url' => 'Isian :attribute bukan URL yang valid.',
    'after' => 'Isian :attribute harus tanggal setelah :date.',
    'after_or_equal' => 'Isian :attribute harus tanggal setelah atau sama dengan :date.',
    'alpha' => 'Isian :attribute hanya boleh mengandung huruf.',
    'alpha_dash' => 'Isian :attribute hanya boleh mengandung huruf, angka, tanda hubung dan garis bawah.',
    'alpha_num' => 'Isian :attribute hanya boleh huruf and angka.',
    'array' => 'Isian :attribute harus berisi himpunan.',
    'before' => 'Isian :attribute harus tanggal sebelum :date.',
    'before_or_equal' => 'Isian :attribute harus tanggal sebelum atau sama dengan :date.',
    'between' => [
        'numeric' => 'Isian :attribute harus diantara :min dan :max.',
        'file' => 'Isian :attribute harus diantara :min dan :max kilobyte.',
        'string' => 'Isian :attribute harus diantara :min dan :max karakter.',
        'array' => 'Isian :attribute harus memiliki barang diantara :min dan :max.',
    ],
    'boolean' => 'Isian :attribute harus bernilai benar atau salah.',
    'confirmed' => 'Isian konfirmasi :attribute tidak cocok.',
    'date' => 'Isian :attribute bukan tanggal yang valid.',
    'date_equals' => 'Isian :attribute harus tanggal yang sama dengan :date.',
    'date_format' => 'Isian :attribute tidak sama dengan format :format.',
    'different' => 'Isian :attribute dan :other harus berbeda.',
    'digits' => 'Isian :attribute harus :digits digit.',
    'digits_between' => 'Isian :attribute harus diantara :min dan :max digit.',
    'dimensions' => 'Isian :attribute memiliki dimensi gambar yang tidak valid.',
    'distinct' => 'Isian :attribute memiliki nilai yang duplikat.',
    'email' => 'Isian :attribute harus surel yang valid.',
    'ends_with' => 'Isian :attribute harus diakhiri dengan nilai berikut: :values.',
    'exists' => 'Isian :attribute terpilih tidak valid.',
    'file' => 'Isian :attribute harus berupa berkas.',
    'filled' => 'Isian :attribute harus memiliki nilai.',
    'gt' => [
        'numeric' => 'Isian :attribute harus lebih besar dari :value.',
        'file' => 'Isian :attribute harus lebih besar dari :value kilobyte.',
        'string' => 'Isian :attribute harus lebih besar dari :value karakter.',
        'array' => 'Isian :attribute harus memiliki barang lebih besar dari :value.',
    ],
    'gte' => [
        'numeric' => 'Isian :attribute harus lebih besar dari atau sama dengan :value.',
        'file' => 'Isian :attribute harus lebih besar dari atau sama dengan :value kilobyte.',
        'string' => 'Isian :attribute harus lebih besar dari atau sama dengan :value karakter.',
        'array' => 'Isian :attribute harus memiliki barang :value atau lebih.',
    ],
    'image' => 'Isian :attribute harus berupa gambar.',
    'in' => 'Isian :attribute terpilih tidak valid.',
    'in_array' => 'Isian :attribute tidak ada di dalam :other.',
    'integer' => 'Isian :attribute harus berupa bilangan bulat.',
    'ip' => 'Isian :attribute harus berupa alamat IP yang valid.',
    'ipv4' => 'Isian :attribute harus berupa alamat IPv4 yang valid.',
    'ipv6' => 'Isian :attribute harus berupa alamat IPv6 yang valid.',
    'json' => 'Isian :attribute harus berupa rangkaian JSON yang valid.',
    'lt' => [
        'numeric' => 'Isian :attribute harus lebih kecil dari :value.',
        'file' => 'Isian :attribute harus lebih kecil dari :value kilobyte.',
        'string' => 'Isian :attribute harus lebih kecil dari :value karakter.',
        'array' => 'Isian :attribute harus memiliki barang lebih kecil dari :value.',
    ],
    'lte' => [
        'numeric' => 'Isian :attribute harus lebih kecil dari atau sama dengan :value.',
        'file' => 'Isian :attribute harus lebih kecil dari atau sama dengan :value kilobyte.',
        'string' => 'Isian :attribute harus lebih kecil dari atau sama dengan :value karakter.',
        'array' => 'Isian :attribute harus memiliki barang tidak lebih dari :value.',
    ],
    'max' => [
        'numeric' => 'Isian :attribute tidak boleh lebih besar dari :max.',
        'file' => 'Isian :attribute tidak boleh lebih besar dari :max kilobyte.',
        'string' => 'Isian :attribute tidak boleh lebih besar dari :max karakter.',
        'array' => 'Isian :attribute tidak boleh memiliki barang lebih dari :max.',
    ],
    'mimes' => 'Isian :attribute harus berupa berkas yang bertipe: :values.',
    'mimetypes' => 'Isian :attribute harus berupa berkas yang bertipe: :values.',
    'min' => [
        'numeric' => 'Isian :attribute harus setidaknya :min.',
        'file' => 'Isian :attribute harus setidaknya :min kilobyte.',
        'string' => 'Isian :attribute harus setidaknya :min karakter.',
        'array' => 'Isian :attribute harus memiliki barang setidaknya :min.',
    ],
    'not_in' => 'Isian :attribute terpilih tidak valid.',
    'not_regex' => 'Isian format :attribute tidak valid.',
    'numeric' => 'Isian :attribute harus berupa angka.',
    'password' => 'Isian kata sandi tidak tepat.',
    'present' => 'Isian :attribute harus ada.',
    'regex' => 'Isian format :attribute tidak valid.',
    'required' => 'Isian :attribute wajid diisi.',
    'required_if' => 'Isian :attribute wajib diisi ketika :other adalah :value.',
    'required_unless' => 'Isian :attribute wajib diisi kecuali jika :other di dalam :values.',
    'required_with' => 'Isian :attribute wajib diisi ketika :values ada.',
    'required_with_all' => 'Isian :attribute wajib diisi when :values ada.',
    'required_without' => 'Isian :attribute wajib diisi when :values tidak ada.',
    'required_without_all' => 'Isian :attribute wajib diisi ketika tidak ada satupun dari :values.',
    'same' => 'Isian :attribute dan :other harus cocok.',
    'size' => [
        'numeric' => 'Isian :attribute harus :size.',
        'file' => 'Isian :attribute harus :size kilobyte.',
        'string' => 'Isian :attribute harus :size karakter.',
        'array' => 'Isian :attribute harus mengandung barang :size.',
    ],
    'starts_with' => 'Isian :attribute harus dimulai dari salah satu nilai berikut: :values.',
    'string' => 'Isian :attribute harus berupa rangkaian.',
    'timezone' => 'Isian :attribute harus berupa zona waktu yang valid.',
    'unique' => 'Isian :attribute sudah digunakan.',
    'uploaded' => 'Isian :attribute gagal diunggah.',
    'url' => 'Isian format :attribute tidak valid.',
    'uuid' => 'Isian :attribute harus berupa UUID yang valid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
