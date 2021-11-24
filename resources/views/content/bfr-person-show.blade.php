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
                                    <h6 class="text-white text-capitalize ps-3">Detail Orang &middot; {{ $person->name }}
                                    </h6>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="{{ route('person.index') }}"
                                        class="btn btn-outline-white btn-sm mb-1 me-3">Kembali ke Daftar Orang</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-xs-12 col-md-3">
                                <div class="d-flex mb-3">
                                    <img src="{{ asset('assets/img/no-avatar.png') }}"
                                        class="img-fluid border-radius-lg mx-auto" alt="user1">
                                </div>
                                <div class="d-grid gap-2 mb-3">
                                    <a href="{{ route('person.family.tree', ['id' => $person->id]) }}"
                                        class="btn btn-secondary btn-block mb-1 me-3">Lihat Diagram Silsilah</a>
                                    <a href="{{ route('person.edit', ['id' => $person->id]) }}"
                                        class="btn btn-info btn-block mb-1 me-3">Edit</a>
                                    @if (in_array(Auth::user()->detail->role->code, ['superadmin']))
                                        <a href="javascript:void(0)" class="btn btn-danger btn-block mb-1 me-3"
                                            data-bs-toggle="modal" data-bs-target="#deletePersonModal">Hapus</a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-9">
                                <div class="card">
                                    <div class="card-body p-3">
                                        <span class="text-uppercase text-dark text-xs font-weight-bolder">Data
                                            Pribadi</span>
                                        <ul class="list-group mt-3">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span
                                                    class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 text-nowrap">Nama</span>
                                                <span>{{ $person->name ?? '-' }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span
                                                    class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 text-nowrap">Nama
                                                    Panggilan</span>
                                                <span>{{ $person->nickname ?? '-' }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span
                                                    class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 text-nowrap">Surel</span>
                                                <span>{{ $person->email ?? '-' }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span
                                                    class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 text-nowrap">No
                                                    HP</span>
                                                <span>{{ $person->phone ?? '-' }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span
                                                    class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 text-nowrap">Jenis
                                                    Kelamin</span>
                                                <span>{{ $person->gender ? __('general.' . $person->gender) : '-' }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span
                                                    class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 text-nowrap">NIK
                                                    / No KTP</span>
                                                <span>{{ $person->identification_number ?? '-' }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span
                                                    class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 text-nowrap">Anak
                                                    ke</span>
                                                <span>{{ $person->child_number ?? '-' }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span
                                                    class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 text-nowrap">Tempat
                                                    Lahir</span>
                                                <span>{{ $person->birth_place ?? '-' }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span
                                                    class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 text-nowrap">Tanggal
                                                    Lahir</span>
                                                <span>{{ $person->birth_date ? $person->birth_date->ISOformat('LL') . ' (' . $person->birth_date->age . ' tahun)' : '-' }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span
                                                    class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 text-nowrap">Status
                                                    Pernikahan</span>
                                                <span>{{ $person->marital_status ? __('general.' . $person->marital_status) : '-' }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span
                                                    class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 text-nowrap">Status
                                                    Hidup</span>
                                                <span>{{ $person->life_status ? __('general.' . $person->life_status) : '-' }}</span>
                                            </li>
                                            @if ($person->life_status != 'alive')
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center">
                                                    <span
                                                        class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 text-nowrap">Tanggal
                                                        Kematian</span>
                                                    <span>{{ $person->dead_date ? $person->dead_date->ISOformat('LL') : '-' }}</span>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                <div class="card mt-3">
                                    <div class="card-body p-3">
                                        <span class="text-uppercase text-dark text-xs font-weight-bolder">Tempat
                                            Tinggal</span>
                                        <ul class="list-group mt-3">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span
                                                    class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 text-nowrap">Alamat</span>
                                                <span>{{ $person->address ?? '-' }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span
                                                    class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 text-nowrap">Provinsi</span>
                                                <span>{{ $person->province ?? '-' }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span
                                                    class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 text-nowrap">Kota
                                                    / Kabupaten</span>
                                                <span>{{ $person->city ?? '-' }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span
                                                    class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 text-nowrap">Kecamatan</span>
                                                <span>{{ $person->district ?? '-' }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span
                                                    class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 text-nowrap">Desa
                                                    / Kelurahan</span>
                                                <span>{{ $person->village ?? '-' }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card mt-3">
                                    <div class="card-body p-3">
                                        <span class="text-uppercase text-dark text-xs font-weight-bolder">Orang Tua</span>
                                        <ul class="list-group mt-3">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span
                                                    class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 text-nowrap">Nama
                                                    Ayah</span>
                                                <a
                                                    href="{{ $person->father_id ? route('person.show', ['id' => $person->father_id]) : 'javascript:void(0) ' }}">
                                                    <span>{{ $person->father_id && $person->father->name ? $person->father->name : '-' }}</span>
                                                </a>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span
                                                    class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 text-nowrap">Nama
                                                    Ibu</span>
                                                <a
                                                    href="{{ $person->mother_id ? route('person.show', ['id' => $person->mother_id]) : 'javascript:void(0) ' }}">
                                                    <span>{{ $person->mother_id && $person->mother->name ? $person->mother->name : '-' }}</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card mt-3">
                                    <div class="card-body p-3">
                                        <span class="text-uppercase text-dark text-xs font-weight-bolder">Saudara (Kakak &
                                            Adik)</span>
                                        <ul class="list-group mt-3">
                                            @forelse ($allSiblings as $sibling)
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center">
                                                    <span
                                                        class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 text-nowrap">Nama
                                                        {{ $sibling['gender'] == 'man' ? 'Saudara' : 'Saudari' }}</span>
                                                    <a href="{{ route('person.show', ['id' => $sibling['id']]) }}">
                                                        <span>{{ $sibling['name'] ?? '-' }}</span>
                                                    </a>
                                                </li>
                                            @empty
                                                <li
                                                    class="list-group-item d-flex justify-content-center align-items-center font-italic">
                                                    Tidak ada data saudara</li>
                                            @endforelse
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
                            <div class="row">
                                <div class="col-6 d-flex align-items-center">
                                    <h6 class="text-white text-capitalize ps-3">Keluarga
                                        ({{ $spouse->name }} & Anak)</h6>
                                </div>
                                @if (in_array(Auth::user()->detail->role->code, ['superadmin', 'admin']))
                                <div class="col-6 d-flex align-items-center justify-content-end">
                                    <a href="{{ route('partner.create') . '?' . $spouse->me_key . '=' . $person->id }}"
                                        class="btn btn-outline-white btn-sm mb-1 me-3">Tambahkan Relasi
                                        ke {{ $spouse->name }}</a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            @forelse ($partners as $partner)
                                <div class="col-xs-12 col-md-6 col-lg-4">
                                    <div class="card mb-3 position-relative">
                                        <a class="position-absolute top-0 end-0 p-3"
                                            href="{{ route('partner.edit', ['id' => $partner->id]) }}">
                                            <div class="text-center d-flex align-items-center justify-content-center"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Edit Relasi ke {{ $spouse->name . ' ' . $partner->{$spouse->code}->name }}">
                                                <i class="material-icons opacity-10">edit</i>
                                            </div>
                                        </a>
                                        <div class="d-flex">
                                            <div class="py-3 ps-3">
                                                <img src="{{ asset('assets/img/no-avatar.png') }}"
                                                    class="img-responsive rounded-circle" style="max-width: 75px;">
                                            </div>
                                            <div class="">
                                                <div class="card-body">
                                                    <a
                                                        href="{{ route('person.show', ['id' => $partner->{$spouse->key}]) }}">
                                                        <h5 class="card-title text-sm">
                                                            {{ $partner->{$spouse->code}->name }}</h5>
                                                    </a>
                                                    <p class="card-text text-xs">
                                                        <span>Umur
                                                            {{ $partner->{$spouse->code}->birth_date ? $partner->{$spouse->code}->birth_date->age : '-' }}
                                                            tahun</span>
                                                        <br>
                                                        <span>{{ $spouse->name }} &middot;
                                                            {{ $partner->marriage_date ? $partner->marriage_date->ISOformat('LL') : '' }}</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-xs-12 px-3">
                                    <div
                                        class="d-flex justify-content-center align-items-center font-italic border border-1 rounded py-2">
                                        Tidak ada data {{ $spouse->name }}</div>
                                </div>
                            @endforelse
                        </div>
                        <div class="row mt-3">
                            @forelse ($children as $child)
                                <div class="col-xs-12 col-md-6 col-lg-4">
                                    <div class="card mb-3">
                                        <div class="d-flex">
                                            <div class="py-3 ps-3">
                                                <img src="{{ asset('assets/img/no-avatar.png') }}"
                                                    class="img-responsive rounded-circle" style="max-width: 75px;">
                                            </div>
                                            <div class="">
                                                <div class="card-body">
                                                    <a href="{{ route('person.show', ['id' => $child->id]) }}">
                                                        <h5 class="card-title text-sm">{{ $child->name }}</h5>
                                                    </a>
                                                    <p class="card-text text-xs">
                                                        <span>{{ __('general.' . $child->gender) }} &middot; Umur
                                                            {{ $child->birth_date ? $child->birth_date->age : '-' }}
                                                            tahun</span>
                                                        <br>
                                                        <span>Anak dari {{ $spouse->name }}
                                                            {{ $child->{$spouse->parent_key} ? $child->{$spouse->parent}->name : '-' }}</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-xs-12 px-3">
                                    <div
                                        class="d-flex justify-content-center align-items-center font-italic border border-1 rounded py-2">
                                        Tidak ada data anak</div>
                                </div>
                            @endforelse
                        </div>
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
                <form action="{{ route('person.destroy') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="delete_person_id" value="{{ $person->id }}">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-normal" id="deletePersonModalLabel">Hapus data orang</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Apakah Anda yakin untuk menghapus data orang ini: {{ $person->name }} ?
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
@endsection
