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
                                    <h6 class="text-white text-capitalize ps-3">Edit Relasi Pasangan</h6>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="{{ route('person.index') }}"
                                        class="btn btn-outline-white btn-sm mb-1 me-3">Hapus Relasi Pasangan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <form role="form" action="{{ route('partner.update', ['id' => $partner->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="input-group input-group-static mb-3">
                                <label class="m-0">Suami <small class="text-danger">*</small></label>
                                <select name="husband_id" class="form-control" id="husbandSearch" required>
                                    <option value="{{ $husband->id }}" selected="selected">
                                        {{ $husband->name }}</option>
                                </select>
                            </div>
                            <div class="input-group input-group-static mb-3">
                                <label class="m-0">Istri <small class="text-danger">*</small></label>
                                <select name="wife_id" class="form-control" id="wifeSearch" required>
                                    <option value="{{ $wife->id }}" selected="selected">
                                        {{ $wife->name }}</option>
                                </select>
                            </div>
                            <div class="input-group input-group-static mb-3">
                                <label class="ms-0">Tanggal Menikah</label>
                                <input type="date" name="marriage_date" class="form-control" autocomplete="off"
                                    autofill="off" value="{{ $partner->marriage_date ? $partner->marriage_date->format('Y-m-d') : '' }}">
                            </div>
                            <input type="hidden" name="referrer" value="{{ request()->server('HTTP_REFERER') }}">
                            <div class="text-center">
                                <button type="submit"
                                    class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#husbandSearch').select2({
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
            $($('#husbandSearch').data('select2').$container).find('span.selection > span.custom-identifier')
                .removeClass().addClass('form-control');

            $('#wifeSearch').select2({
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
            $($('#wifeSearch').data('select2').$container).find('span.selection > span.custom-identifier')
                .removeClass().addClass('form-control');
        });

        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });
    </script>
@endsection
