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
                                    <h6 class="text-white text-capitalize ps-3">Profil Saya</h6>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="{{ route('person.show', ['id' => $user->detail->person->id]) }}"
                                        class="btn btn-outline-white btn-sm mb-1 me-3">Lihat Data Orang Saya</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <form role="form" action="{{ route('account.profile.update') }}" method="POST">
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
                                    <h6 class="text-white text-capitalize ps-3">Ganti Kata Sandi Saya</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <form role="form" action="{{ route('account.profile.update.password') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="input-group input-group-static mb-3">
                                <label class="ms-0">{{ __('validation.attributes.current_password') }} <small
                                        class="text-danger">*</small></label>
                                <input type="password" name="current_password" class="form-control" autocomplete="off"
                                    required autofill="off">
                            </div>
                            <div class="input-group input-group-static mb-3">
                                <label class="ms-0">{{ __('validation.attributes.new_password') }} <small
                                        class="text-danger">*</small></label>
                                <input type="password" name="new_password" class="form-control" autocomplete="off"
                                    required autofill="off">
                            </div>
                            <div class="input-group input-group-static mb-3">
                                <label class="m-0">{{ __('validation.attributes.new_password_confirmation') }} <small
                                        class="text-danger">*</small></label>
                                <input type="password" name="new_password_confirmation" class="form-control"
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

        });
    </script>
@endsection
