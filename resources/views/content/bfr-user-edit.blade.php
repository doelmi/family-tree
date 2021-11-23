@extends('layouts.bfr-app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xs-12 col-lg-6">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <div class="row">
                                <div class="col-6 d-flex align-items-center">
                                    <h6 class="text-white text-capitalize ps-3">Edit Pengguna</h6>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="{{ route('user.index') }}"
                                        class="btn btn-outline-white btn-sm mb-1 me-3">Kembali ke Daftar Pengguna</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <form role="form" action="{{ route('user.update', ['id' => $user->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="input-group input-group-static mb-3">
                                <label class="ms-0">Nama <small class="text-danger">*</small></label>
                                <input type="text" name="name" class="form-control" autocomplete="off" autofill="off"
                                    required value="{{ $user->name }}">
                            </div>
                            <div class="input-group input-group-static mb-3">
                                <label class="ms-0">Surel <small class="text-danger">*</small></label>
                                <input type="email" name="email" class="form-control" autocomplete="off" autofill="off"
                                    required value="{{ $user->email }}">
                            </div>
                            <div class="input-group input-group-static mb-3">
                                <label class="m-0">Peran <small class="text-danger">*</small></label>
                                <select name="role_id" class="form-control" required>
                                    <option value="" {{ $user->detail->role_id ? '' : 'selected' }} disabled>Pilih
                                        peran</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"
                                            {{ $user->detail->role_id == $role->id? 'selected' : '' }}>{{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group input-group-static mb-3">
                                <label class="m-0">Orang <small class="text-danger">*</small></label>
                                <select name="person_id" class="form-control" required id="personSearch">
                                    <option value="{{ $user->detail->person->id }}" selected="selected">
                                        {{ $user->detail->person->name }}</option>
                                </select>
                            </div>
                            <div class="form-check form-check-info text-start ps-0">
                                <input class="form-check-input" name="status" type="checkbox" value="on"
                                    {{ $user->detail->status == 'active' ? 'checked' : '' }} id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Aktif
                                </label>
                            </div>
                            <div class="text-center">
                                <button type="submit"
                                    class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-lg-6">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
                            <div class="row">
                                <div class="col-12 d-flex align-items-center">
                                    <h6 class="text-white text-capitalize ps-3">Ganti Kata Sandi Pengguna</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <form role="form" action="{{ route('user.update.password', ['id' => $user->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="input-group input-group-static mb-3">
                                <label class="ms-0">Kata Sandi <small class="text-danger">*</small></label>
                                <input type="password" name="password" class="form-control" autocomplete="off" required
                                    autofill="off">
                            </div>
                            <div class="input-group input-group-static mb-3">
                                <label class="m-0">Ulangi Kata Sandi <small
                                        class="text-danger">*</small></label>
                                <input type="password" name="password_confirmation" class="form-control"
                                    autocomplete="off" required autofill="off">
                            </div>
                            <div class="text-center">
                                <button type="submit"
                                    class="btn btn-lg bg-gradient-info btn-lg w-100 mt-4 mb-0">Simpan</button>
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
                containerCssClass: "custom-identifier"
            });
            $($('#personSearch').data('select2').$container).find('span.selection > span.custom-identifier')
                .removeClass().addClass('form-control');
        });

        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });
    </script>
@endsection
