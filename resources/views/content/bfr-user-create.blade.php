@extends('layouts.bfr-app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <div class="row">
                                <div class="col-6 d-flex align-items-center">
                                    <h6 class="text-white text-capitalize ps-3">Tambah Pengguna</h6>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="{{ route('user.index') }}"
                                        class="btn btn-outline-white btn-sm mb-1 me-3">Kembali ke Daftar Pengguna</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <form role="form" action="{{ route('user.store') }}" method="POST">
                            @csrf
                            <div class="input-group input-group-static mb-3">
                                <label class="ms-0">Nama <small class="text-danger">*</small></label>
                                <input type="text" name="name" class="form-control" autocomplete="off" autofill="off"
                                    required value="{{ @old('name') }}">
                            </div>
                            <div class="input-group input-group-static mb-3">
                                <label class="ms-0">Surel <small class="text-danger">*</small></label>
                                <input type="email" name="email" class="form-control" autocomplete="off" autofill="off"
                                    required value="{{ @old('email') }}">
                            </div>
                            <div class="input-group input-group-static mb-3">
                                <label class="ms-0">Kata Sandi <small class="text-danger">*</small></label>
                                <input type="password" name="password" class="form-control" autocomplete="off" required
                                    autofill="off" value="{{ @old('password') }}">
                            </div>
                            <div class="input-group input-group-static mb-3">
                                <label class="m-0">Ulangi Kata Sandi <small
                                        class="text-danger">*</small></label>
                                <input type="password" name="password_confirmation" class="form-control"
                                    autocomplete="off" required autofill="off"
                                    value="{{ @old('password_confirmation') }}">
                            </div>
                            <div class="input-group input-group-static mb-3">
                                <label class="m-0">Peran <small class="text-danger">*</small></label>
                                <select name="role_id" class="form-control" required>
                                    <option value="" {{ @old('role_id') ? '' : 'selected' }} disabled>Pilih
                                        peran</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"
                                            {{ @old('role_id') ? 'selected' : '' }}>{{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group input-group-static mb-3">
                                <label class="m-0">Orang <small class="text-danger">*</small></label>
                                <select name="person_id" class="form-control" required id="personSearch">
                                    <option value="{{ @old('person_id') }}" selected="selected">{{ session('person_name') ?? 'Pilih orang' }}</option>
                                </select>
                            </div>
                            <div class="form-check form-check-info text-start ps-0">
                                <input class="form-check-input" name="status" type="checkbox" value="on"
                                    id="flexCheckDefault" checked>
                                <label class="form-check-label" for="flexCheckDefault">
                                    Aktif
                                </label>
                            </div>
                            <div class="text-center">
                                <button type="submit"
                                    class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Buat</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#personSearch').select2({
                ajax: {
                    url: '{{ route('person.search') }}',
                    dataType: 'json',
                    delay: 250,
                },
                minimumInputLength: 3,
                language: 'id',
                containerCssClass : "custom-identifier"
            });
            $($('#personSearch').data('select2').$container).find('span.selection > span.custom-identifier').removeClass().addClass('form-control');
        });

        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });
    </script>
@endsection
