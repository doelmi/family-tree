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
                                    <h6 class="text-white text-capitalize ps-3">Daftar Orang</h6>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="{{ route('person.create') }}"
                                        class="btn btn-outline-white btn-sm mb-1 me-3">Tambah Orang</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Nama</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Kota/Kab</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Orang Tua</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tanggal Dibuat</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status Hidup</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($people as $person)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="{{ asset('assets/img/no-avatar.png') }}"
                                                            class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $person->name }}</h6>
                                                        <p class="text-xs text-secondary mb-0">{{ $person->nickname }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">{{ $person->city }}
                                                </p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                @if ($person->father)
                                                    <h6 class="mb-0 text-sm text-info">{{ $person->father->name }}</h6>
                                                @else
                                                    <h6 class="mb-0 text-sm text-info">-</h6>
                                                @endif
                                                @if ($person->mother)
                                                    <h6 class="mb-0 text-sm text-warning">{{ $person->mother->name }}</h6>
                                                @else
                                                    <h6 class="mb-0 text-sm text-warning">-</h6>
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $person->created_at->format('d M Y') }}</span>
                                            </td>
                                            <td class="align-middle text-center text-xs">
                                                <span
                                                    class="badge badge-pill {{ $person->life_status == 'alive' ? 'bg-gradient-success' : 'bg-gradient-danger' }}">{{ __('general.' . $person->life_status) }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <a href="{{ route('person.show', ['id' => $person->id]) }}"
                                                    class="font-weight-bold text-xs me-2" data-toggle="tooltip"
                                                    data-original-title="Edit Orang">
                                                    Detail
                                                </a>
                                                <a href="{{ route('person.edit', ['id' => $person->id]) }}"
                                                    class="font-weight-bold text-xs" data-toggle="tooltip"
                                                    data-original-title="Edit Orang">
                                                    Edit
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <nav class="m-4">
                            <ul class="pagination justify-content-end">
                                <li class="page-item pe-2 {{ ($people->currentPage() - 1) == 0 ? 'disabled' : '' }}">
                                    <a class="page-link"
                                        href="{{ route('person.index') . '?page=' . ($people->currentPage() - 1) }}"
                                        tabindex="-1">
                                        <span class="material-icons">
                                            keyboard_arrow_left
                                        </span>
                                        <span class="sr-only">Sebelumnya</span>
                                    </a>
                                </li>
                                <li class="page-item pe-2 {{  ceil($people->total() / $people->perPage()) == $people->currentPage() ? 'disabled' : '' }}">
                                    <a class="page-link"
                                        href="{{ route('person.index') . '?page=' . ($people->currentPage() + 1) }}">
                                        <span class="material-icons">
                                            keyboard_arrow_right
                                        </span>
                                        <span class="sr-only">Selanjutnya</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
