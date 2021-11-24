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
                                @if (in_array(Auth::user()->detail->role->code, ['superadmin']))
                                    <div class="col-6 text-end">
                                        <a href="javascript:void(0)" class="btn btn-danger btn-block mb-1 me-3"
                                            data-bs-toggle="modal" data-bs-target="#deletePersonModal">Hapus Relasi
                                            Pasangan</a>
                                    </div>
                                @endif
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
                                    autofill="off"
                                    value="{{ $partner->marriage_date ? $partner->marriage_date->format('Y-m-d') : '' }}">
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

    <!-- Modal -->
    @if (in_array(Auth::user()->detail->role->code, ['superadmin']))
        <div class="modal fade" id="deletePersonModal" tabindex="-1" role="dialog"
            aria-labelledby="deletePersonModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <form action="{{ route('partner.destroy', ['id' => $partner->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="referrer" value="{{ request()->server('HTTP_REFERER') }}">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-normal" id="deletePersonModalLabel">Hapus data relasi pasangan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Apakah Anda yakin untuk menghapus data relasi pasangan ini: {{ $partner->husband->name }} & {{ $partner->wife->name }} ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-outline-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn bg-gradient-danger">Hapus</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif

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
