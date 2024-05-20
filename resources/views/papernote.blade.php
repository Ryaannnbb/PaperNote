@extends('layout_admin.app')

@section('content')
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "{{ session('success') }}"
            });
        </script>
    @endif

    <script>
        var navbarTopShape = window.config.config.phoenixNavbarTopShape;
        var navbarPosition = window.config.config.phoenixNavbarPosition;
        var body = document.querySelector('body');
        var navbarDefault = document.querySelector('#navbarDefault');
        var navbarTop = document.querySelector('#navbarTop');
        var topNavSlim = document.querySelector('#topNavSlim');
        var navbarTopSlim = document.querySelector('#navbarTopSlim');
        var navbarCombo = document.querySelector('#navbarCombo');
        var navbarComboSlim = document.querySelector('#navbarComboSlim');
        var dualNav = document.querySelector('#dualNav');

        var documentElement = document.documentElement;
        var navbarVertical = document.querySelector('.navbar-vertical');

        if (navbarPosition === 'dual-nav') {
            topNavSlim.remove();
            navbarTop.remove();
            navbarVertical.remove();
            navbarTopSlim.remove();
            navbarCombo.remove();
            navbarComboSlim.remove();
            navbarDefault.remove();
            dualNav.removeAttribute('style');
            documentElement.classList.add('dual-nav');
        } else if (navbarTopShape === 'slim' && navbarPosition === 'vertical') {
            navbarDefault.remove();
            navbarTop.remove();
            navbarTopSlim.remove();
            navbarCombo.remove();
            navbarComboSlim.remove();
            topNavSlim.style.display = 'block';
            navbarVertical.style.display = 'inline-block';
            body.classList.add('nav-slim');
        } else if (navbarTopShape === 'slim' && navbarPosition === 'horizontal') {
            navbarDefault.remove();
            navbarVertical.remove();
            navbarTop.remove();
            topNavSlim.remove();
            navbarCombo.remove();
            navbarComboSlim.remove();
            navbarTopSlim.removeAttribute('style');
            body.classList.add('nav-slim');
        } else if (navbarTopShape === 'slim' && navbarPosition === 'combo') {
            navbarDefault.remove();
            //- navbarVertical.remove();
            navbarTop.remove();
            topNavSlim.remove();
            navbarCombo.remove();
            navbarTopSlim.remove();
            navbarComboSlim.removeAttribute('style');
            navbarVertical.removeAttribute('style');
            body.classList.add('nav-slim');
        } else if (navbarTopShape === 'default' && navbarPosition === 'horizontal') {
            navbarDefault.remove();
            topNavSlim.remove();
            navbarVertical.remove();
            navbarTopSlim.remove();
            navbarCombo.remove();
            navbarComboSlim.remove();
            navbarTop.removeAttribute('style');
            documentElement.classList.add('navbar-horizontal');
        } else if (navbarTopShape === 'default' && navbarPosition === 'combo') {
            topNavSlim.remove();
            navbarTop.remove();
            navbarTopSlim.remove();
            navbarDefault.remove();
            navbarComboSlim.remove();
            navbarCombo.removeAttribute('style');
            navbarVertical.removeAttribute('style');
            documentElement.classList.add('navbar-combo')

        } else {
            topNavSlim.remove();
            navbarTop.remove();
            navbarTopSlim.remove();
            navbarCombo.remove();
            navbarComboSlim.remove();
            navbarDefault.removeAttribute('style');
            navbarVertical.removeAttribute('style');
        }

        var navbarTopStyle = window.config.config.phoenixNavbarTopStyle;
        var navbarTop = document.querySelector('.navbar-top');
        if (navbarTopStyle === 'darker') {
            navbarTop.classList.add('navbar-darker');
        }

        var navbarVerticalStyle = window.config.config.phoenixNavbarVerticalStyle;
        var navbarVertical = document.querySelector('.navbar-vertical');
        if (navbarVerticalStyle === 'darker') {
            navbarVertical.classList.add('navbar-darker');
        }
    </script>
    <div class="content">
        <nav class="mb-2" aria-label="breadcrumb">
        </nav>
        <nav class="mb-2" aria-label="breadcrumb">
        </nav>
        <div class="mb-9">
            <div class="row g-3 mb-4">
                <div class="col-auto">
                    <h2 class="mb-0">Kamar</h2>
                </div>
            </div>
            <ul class="nav nav-links mb-3 mb-lg-2 mx-n3">
                <li class="nav-item">
                    <p class="nav-link active my-n2" aria-current="page"><span>Semua </span><span
                            class="text-700 fw-semi-bold">
                            @if ($papernote->count() > 0)
                                <span>({{ $papernote->count() }})</span>
                            @endif
                        </span></p>
                </li>
            </ul>
            <div id="products"
                data-list='{"valueNames":["product","price","category","tags","vendor","time"],"page":5,"pagination":true}'>
                <div class="mb-4">
                    <div class="d-flex flex-wrap gap-3">
                        <div class="search-box">
                            <form class="position-relative" data-bs-toggle="search" data-bs-display="static">
                                <input class="form-control search-input search" type="search" placeholder="Search rooms"
                                    aria-label="Search" />
                                <span class="fas fa-search search-box-icon"></span>
                            </form>
                        </div>
                        <div class="scrollbar overflow-hidden-y">
                            <div class="btn-group position-static" role="group">
                                <div class="ms-xxl-auto">
                                    <button class="btn btn-link text-900 me-4 px-0"></button>
                                    <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">Tambah Catatan</button>
                                    <div class="modal fade" id="exampleModal" tabindex="-1" style="display: none;"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="{{ route('papernote.store') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Catatan</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="exampleFormControlInput">Judul Catatan</label>
                                                            <input class="form-control" id="exampleFormControlInput"
                                                                type="text" name="judul" placeholder="Masukkan Judul Catatan">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="customFile">Gambar (opsional)</label>
                                                            <div id="imagePreview"></div>
                                                            <div class="d-flex align-items-center flex-column">
                                                                <input type="file" name="gambar" id="formFile" class="form-control   @error('gambar') is-invalid @enderror"
                                                                value="{{ old('gambar') }}">
                                                                <img class="mt-2" id="image-preview" src="#" alt="Preview" style="display: none; width: 50%; height: auto; border-radius: 5px">
                                                            </div>
                                                            <script>
                                                                document.getElementById('formFile').addEventListener('change', function(e) {
                                                                    const file = e.target.files[0];
                                                                    const reader = new FileReader();
                                                                    reader.onload = function(e) {
                                                                        document.getElementById('image-preview').src = e.target.result;
                                                                        document.getElementById('image-preview').style.display = 'block';
                                                                    }
                                                                    reader.readAsDataURL(file);
                                                                });
                                                            </script>
                                                        </div>
                                                        <div class="mb-0">
                                                            <label class="form-label" for="exampleTextarea">Isi Catatan
                                                            </label>
                                                            <textarea class="form-control" id="exampleTextarea" rows="3" name="isi"> </textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer"><button class="btn btn-primary"
                                                            type="submit">Tambah</button><button class="btn btn-outline-primary"
                                                            type="button" data-bs-dismiss="modal">Cancel</button></div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                </thead>
                <tbody class="list" id="products-table-body text-center">

                    <div class="row">
                        @foreach ($papernote as $papernotes)
                            <div class="col-12 col-sm-6 col-md-4 col-xxl-2 room">
                                <div class="card mb-3">
                                    <div class="position-relative">
                                        <div class="position-absolute top-0 end-0 m-2">
                                            <div class="font-sans-serif btn-reveal-trigger position-static">
                                                <button
                                                    class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs--2"
                                                    type="button" data-bs-toggle="dropdown" data-boundary="window"
                                                    aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                                                    <span class="fas fa-ellipsis-h fs--2 text-white"></span>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end py-2">
                                                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#editModal{{ $papernotes->id }}">Launch basic modal</button>
                                                    <div class="modal fade" id="editModal{{ $papernotes->id }}" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5><button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs--1"></span></button>
                                                                </div>
                                                            <div class="modal-body">
                                                                <p class="text-700 lh-lg mb-0">This is a static modal example (meaning its position and display have been overridden). Included are the modal header, modal body (required for padding), and modal footer (optional). </p>
                                                            </div>
                                                                <div class="modal-footer"><button class="btn btn-primary" type="button">Okay</button><button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Cancel</button></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="dropdown-divider"></div>
                                                    <form action="{{ route('papernote.destroy', $papernotes->id) }}"
                                                        method="POST" class="hapus-form">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="button"
                                                            class="dropdown-item text-danger hapus">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal{{ $papernotes->id }}">
                                    @if ($papernotes->gambar && $papernotes->gambar !== 'mynote.png')
                                        <img class="card-img-top" src="{{ asset('storage/papernote/' . $papernotes->gambar) }}" style="object-fit: cover; height: 200px;">
                                    @else
                                        <img class="card-img-top" src="{{ asset('assets/img/products/details/mynote.png') }}" style="object-fit: cover; height: 200px;">
                                    @endif
                                    </a>
                                    <div class="card-footer">
                                        <div class="d-flex align-items-center mb-1">
                                            <h3 class="text-1100 mb-0">
                                                {{ $papernotes->judul}}</h3>
                                            <div class="flex-grow-1"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="modal{{ $papernotes->id }}" tabindex="-1"
                                aria-labelledby="modal{{ $papernotes->id }}Label" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modal{{ $papernotes->id }}Label">
                                                {{ $papernotes->nama_kamar }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Kategori:
                                                {{ $papernotes->kategori ? $papernotes->kategori->nama_kategori : 'Tidak Ada Kategori' }}
                                            </p>
                                            <p>Deskripsi:
                                                {{ strip_tags(Str::limit($papernotes->deskripsi, 10, $end = '...')) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            var searchInput = document.querySelector('.search-input');
                            searchInput.addEventListener('input', function() {
                                var searchTerm = this.value.trim().toLowerCase();
                                var rooms = document.querySelectorAll('.room');

                                rooms.forEach(function(room) {
                                    var roomName = room.querySelector('.room-name').textContent.trim()
                                        .toLowerCase();

                                    if (roomName.includes(searchTerm)) {
                                        room.style.display =
                                            'block';
                                    } else {
                                        room.style.display =
                                            'none';
                                    }
                                });

                                if (searchTerm === '') {
                                    rooms.forEach(function(room) {
                                        room.style.display = 'block';
                                    });
                                }
                            });
                        });
                    </script>

                </tbody>
                </table>
            </div>

            <style>
                .hr {
                    margin-top: -2px;
                }

                .ellipsis-text {
                    max-width: 200px;
                    /* Sesuaikan dengan lebar maksimum yang diinginkan */
                    white-space: nowrap;
                    overflow: hidden;
                    text-overflow: ellipsis;
                    font-size: 14px;
                    /* Sesuaikan dengan ukuran font yang diinginkan */
                }

                .room {
                    transition: opacity 0.3s ease;
                }
            </style>
            {{-- {{ END }} --}}
            <script>
                $('.hapus').click(function() {
                    var form = $(this).closest('form');

                    Swal.fire({
                        title: "Are you sure?",
                        text: "You will delete this product. This action cannot be undone!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, accept!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            </script>
        </div>
    </div>
    </div>
    </div>

    <footer class="footer position-absolute">
        <div class="row g-0 justify-content-between align-items-center h-100">
            <div class="col-12 col-sm-auto text-center">
                <p class="mb-0 mt-2 mt-sm-0 text-900">Copyright © Small<span class="d-none d-sm-inline-block"></span><span
                        class="d-none d-sm-inline-block mx-1">|</span><br class="d-sm-none" />2024</p>
            </div>
            <div class="col-12 col-sm-auto text-center">
            </div>
        </div>
    </footer>
    </div>
@endsection
