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
                                    <h6 class="text-white text-capitalize ps-3">Tambah Orang</h6>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="{{ route('person.index') }}"
                                        class="btn btn-outline-white btn-sm mb-1 me-3">Kembali ke Daftar Orang</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <form role="form" action="{{ route('person.store') }}" method="POST">
                            @csrf
                            <div class="input-group input-group-static mb-3">
                                <label class="ms-0">Nama <small class="text-danger">*</small></label>
                                <input type="text" name="name" class="form-control" autocomplete="off" autofill="off"
                                    required value="{{ @old('name') }}">
                            </div>
                            <div class="input-group input-group-static mb-3">
                                <label class="ms-0">Nama Panggilan</label>
                                <input type="text" name="nickname" class="form-control" autocomplete="off" autofill="off"
                                    value="{{ @old('nickname') }}">
                            </div>
                            <div class="input-group input-group-static mb-3">
                                <label class="ms-0">Surel</label>
                                <input type="email" name="email" class="form-control" autocomplete="off" autofill="off"
                                    value="{{ @old('email') }}">
                            </div>
                            <div class="input-group input-group-static mb-3">
                                <label class="ms-0">No HP</label>
                                <input type="text" name="phone" class="form-control" autocomplete="off" autofill="off"
                                    value="{{ @old('phone') }}">
                            </div>
                            <div class="input-group input-group-static mb-3">
                                <label class="ms-0">NIK / No KTP</label>
                                <input type="text" name="identification_number" class="form-control" autocomplete="off"
                                    autofill="off" value="{{ @old('identification_number') }}">
                            </div>
                            <div class="form-group mb-3">
                                <label class="ms-0">Jenis Kelamin <small class="text-danger">*</small></label>
                                <div class="form-check mb-1 ps-1">
                                    <input class="form-check-input" type="radio" name="gender" id="customRadio1"
                                        value="man" required>
                                    <label class="custom-control-label" for="customRadio1">Laki-laki</label>
                                </div>
                                <div class="form-check ps-1">
                                    <input class="form-check-input" type="radio" name="gender" id="customRadio2"
                                        value="woman" required>
                                    <label class="custom-control-label" for="customRadio2">Perempuan</label>
                                </div>
                            </div>
                            <div class="input-group input-group-static mb-3">
                                <label class="ms-0">Anak ke</label>
                                <input type="number" min="1" max="30" name="child_number" class="form-control" autocomplete="off"
                                    autofill="off" value="{{ @old('child_number') }}">
                            </div>
                            <div class="input-group input-group-static mb-3">
                                <label class="ms-0">Tempat Lahir</label>
                                <input type="text" name="birth_place" class="form-control" autocomplete="off"
                                    autofill="off" value="{{ @old('birth_place') }}">
                            </div>
                            <div class="input-group input-group-static mb-3">
                                <label class="ms-0">Tanggal Lahir</label>
                                <input type="date" name="birth_date" class="form-control" autocomplete="off"
                                    autofill="off" value="{{ @old('birth_date') }}">
                            </div>
                            <div class="input-group input-group-static mb-3">
                                <label class="m-0">Pendidikan Terakhir</label>
                                <select name="education" class="form-control">
                                    <option value="" {{ @old('education') ? '' : 'selected' }} disabled>Pilih
                                        pendidikan terakhir</option>
                                    @foreach ($educations as $eKey)
                                        <option value="{{ $eKey }}" {{ @old('education') ? 'selected' : '' }}>
                                            {{ __("general.$eKey") }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group input-group-static mb-3">
                                <label class="m-0">Status Pernikahan</label>
                                <select name="marital_status" class="form-control">
                                    <option value="" {{ @old('marital_status') ? '' : 'selected' }} disabled>Pilih
                                        status pernikahan</option>
                                    @foreach ($maritalStatus as $msKey)
                                        <option value="{{ $msKey }}"
                                            {{ @old('marital_status') ? 'selected' : '' }}>
                                            {{ __("general.$msKey") }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-check form-check-info text-start ps-0">
                                <input class="form-check-input" name="life_status" type="checkbox" value="alive"
                                    id="lifeStatusCheck" checked>
                                <label class="form-check-label" for="lifeStatusCheck">
                                    Hidup
                                </label>
                            </div>

                            <div class="input-group input-group-static mb-3" id="deadDateDiv">
                                <label class="ms-0">Tanggal Kematian</label>
                                <input type="date" name="dead_date" class="form-control" autocomplete="off"
                                    autofill="off" value="{{ @old('dead_date') }}">
                            </div>

                            <div class=" mt-3 mb-2">
                                <span class="text-center text-uppercase text-secondary text-sm font-weight-bolder">
                                    Tempat Tinggal</span>
                            </div>
                            <div class="input-group input-group-static mb-3">
                                <label class="m-0">Alamat</label>
                                <textarea name="address" class="form-control">{{ @old('address') }}</textarea>
                            </div>
                            <div class="input-group input-group-static mb-3">
                                <label class="m-0">Provinsi</label>
                                <select name="province" class="form-control" id="provinceSearch">

                                </select>
                            </div>
                            <div class="input-group input-group-static mb-3">
                                <label class="m-0">Kota / Kabupaten</label>
                                <select name="city" class="form-control" id="citySearch">
                                </select>
                            </div>
                            <div class="input-group input-group-static mb-3">
                                <label class="m-0">Kecamatan</label>
                                <select name="district" class="form-control" id="districtSearch">
                                </select>
                            </div>
                            <div class="input-group input-group-static mb-3">
                                <label class="m-0">Desa / Kelurahan</label>
                                <select name="village" class="form-control" id="villageSearch">
                                </select>
                            </div>

                            <div class=" mt-3 mb-2">
                                <span class="text-center text-uppercase text-secondary text-sm font-weight-bolder">
                                    Orang Tua</span>
                            </div>
                            <div class="input-group input-group-static mb-3">
                                <label class="m-0">Ayah</label>
                                <select name="father_id" class="form-control" id="fatherSearch">
                                    <option value="{{ @old('father_id') }}" selected="selected">
                                        {{ session('father_name') ?? 'Pilih orang' }}</option>
                                </select>
                            </div>
                            <div class="input-group input-group-static mb-3">
                                <label class="m-0">Ibu</label>
                                <select name="mother_id" class="form-control" id="motherSearch">
                                    <option value="{{ @old('mother_id') }}" selected="selected">
                                        {{ session('mother_name') ?? 'Pilih orang' }}</option>
                                </select>
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
            $('#fatherSearch').select2({
                ajax: {
                    url: '{{ route('person.search') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        var query = {
                            term: params.term,
                            gender: 'man'
                        }
                        return query;
                    }
                },
                minimumInputLength: 3,
                language: 'id',
                containerCssClass: "custom-identifier"
            });
            $($('#fatherSearch').data('select2').$container).find('span.selection > span.custom-identifier')
                .removeClass().addClass('form-control');

            $('#motherSearch').select2({
                ajax: {
                    url: '{{ route('person.search') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        var query = {
                            term: params.term,
                            gender: 'woman'
                        }
                        return query;
                    }
                },
                minimumInputLength: 3,
                language: 'id',
                containerCssClass: "custom-identifier"
            });
            $($('#motherSearch').data('select2').$container).find('span.selection > span.custom-identifier')
                .removeClass().addClass('form-control');

            $.get("{{ route('zone.province') }}", function(data) {
                let provinceHtml = `<option value="">Pilih provinsi</option>`;
                data.forEach(province => {
                    provinceHtml +=
                        `<option data-province-id="${province.id}" value="${province.name}">${province.name}</option>`
                });
                $("#provinceSearch").html(provinceHtml).change();
            });
            $("#provinceSearch").change(function() {
                let selectedProvince = $("#provinceSearch").find(":selected");
                $.get(`{{ route('zone.city') }}?province_id=${$(selectedProvince).data('province-id')}`,
                    function(data) {
                        let cityHtml = `<option value="">Pilih kota / kabupaten</option>`;
                        data.forEach(city => {
                            cityHtml +=
                                `<option data-city-id="${city.id}" value="${city.name}">${city.name}</option>`
                        });
                        $("#citySearch").html(cityHtml);
                        $("#districtSearch").html('');
                        $("#villageSearch").html('');
                    });
            });
            $("#citySearch").change(function() {
                let selectedCity = $("#citySearch").find(":selected");
                $.get(`{{ route('zone.district') }}?city_id=${$(selectedCity).data('city-id')}`,
                    function(data) {
                        let districtHtml = `<option value="">Pilih kecamatan</option>`;
                        data.forEach(district => {
                            districtHtml +=
                                `<option data-district-id="${district.id}" value="${district.name}">${district.name}</option>`
                        });
                        $("#districtSearch").html(districtHtml);
                        $("#villageSearch").html('');
                    });
            });
            $("#districtSearch").change(function() {
                let selectedDistrict = $("#districtSearch").find(":selected");
                $.get(`{{ route('zone.village') }}?district_id=${$(selectedDistrict).data('district-id')}`,
                    function(data) {
                        let villagetHtml = `<option value="">Pilih desa / kelurahan</option>`;
                        data.forEach(village => {
                            villagetHtml +=
                                `<option data-village-id="${village.id}" value="${village.name}">${village.name}</option>`
                        });
                        $("#villageSearch").html(villagetHtml);
                    });
            });

            $("#lifeStatusCheck").change(function () {
                if (this.checked) {
                    $("#deadDateDiv").hide();
                } else {
                    $("#deadDateDiv").show();
                }
            }).change();
        });

        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });
    </script>
@endsection
