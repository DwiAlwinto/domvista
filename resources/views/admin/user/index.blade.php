<div class="page-wrapper">

    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Users
                    </h2>
                    <div class="text-secondary mb-4">
                        There are {{ $totalUsers }} users
                    </div>
                </div>

                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert" id="success-alert">
                        <h4 class="alert-title">Wow! Everything worked!</h4>
                        <div class="text-secondary">{{ session('success') }}</div>
                    </div>
                    
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            setTimeout(function() {
                                const successAlert = document.getElementById('success-alert');
                                if (successAlert) {
                                    successAlert.style.transition = 'opacity 0.5s';
                                    successAlert.style.opacity = '0';
                                    setTimeout(() => successAlert.remove(), 500); // Hapus dari DOM setelah animasi selesai
                                }
                            }, 3000); // 3 detik
                        });
                    </script>
                @endif


              
                    <!-- Page title actions -->
                    <div class="col-auto ms-auto d-print-none">
                        <div class="d-flex">
                            <input type="search" class="form-control d-inline-block w-9 me-3" id="search-user" placeholder="Search user…"/>
                        
                            <a href="/admin/user/create" class="btn btn-custom-primary btn-3">
                                <!-- Download SVG icon from http://tabler.io/icons/icon/plus -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-2"><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                                    New user
                            </a>
                        </div>
                    </div>
            </div>

            <div class="row row-card mt-2">
                @foreach ( $user as $item)
                <div class="col-md-6 col-lg-3">
                  <div class="card">
                    <div class="card-body p-4 text-center">
                        <span 
                            class="avatar avatar-xxl mb-3 rounded"
                            style="background-image: url({{ asset('storage/' . $item->foto_profil) }}); 
                                   cursor: pointer;
                                   width: 150px;
                                   height: 170px;"
                            data-bs-toggle="modal" 
                            data-bs-target="#imageModal"
                            onclick="setModalImage('{{ asset('storage/' . $item->foto_profil) }}')">
                        </span>
                        
                        <h3 class="m-0 mb-1 text-success"><a href="#">{{ $item->name }}</a></h3>
                       
                        <div class="mt-3">
                            <span class="badge bg-green-lt">{{ $item->role }}</span>
                        </div>
                    </div>

                        <div class="d-flex">
                    <style>
    .email-gradient {
        background: linear-gradient(135deg, #4b7bec, #a55eea);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        stroke: url(#emailGradient);
    }
</style>

<a href="#" class="card-btn">
    <svg width="24" height="24" viewBox="0 0 24 24" class="icon me-2 icon-3 email-gradient">
        <defs>
            <linearGradient id="emailGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" stop-color="#4b7bec" />
                <stop offset="100%" stop-color="#a55eea" />
            </linearGradient>
        </defs>
        <path fill="none" stroke="url(#emailGradient)" stroke-width="1.5" d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" />
        <path fill="none" stroke="url(#emailGradient)" stroke-width="1.5" d="M3 7l9 6l9 -6" />
    </svg>
    <span class="badge bg-purple-lt"> {{$item->email}}</span>
</a>
                        
                        </div>
                        <!-- Tambahkan action untuk Edit dan Delete di sini -->
                        <div class="d-flex justify-content-center p-3">
                            <a href="/admin/user/{{ $item->id }}/edit" class="btn btn-custom-primary btn-sm me-2">
                                <!-- Edit Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                    <path d="M16 5l3 3" />
                                </svg>
                                Edit
                            </a>


                            <form action="/admin/user/{{ $item->id }}" method="POST" id="delete-form-{{ $item->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm delete-button" data-bs-toggle="modal" data-bs-target="#delete-confirm-modal" data-form-id="delete-form-{{ $item->id }}">
                                    <!-- Delete Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M4 7l16 0" />
                                        <path d="M10 11l0 6" />
                                        <path d="M14 11l0 6" />
                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                    </svg>
                                    Delete
                                </button>
                            </form>

                        </div>

                     </div>
            
                </div>
                @endforeach
            </div>

         <!-- Tampilkan pagination -->
            <div class="d-flex mt-4">
                <ul class="pagination ms-auto">
                    <!-- Tombol Previous -->
                    <li class="page-item {{ $users->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $users->previousPageUrl() }}" tabindex="-1" aria-disabled="{{ $users->onFirstPage() ? 'true' : 'false' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-1"><path d="M15 6l-6 6l6 6" /></svg>
                            prev
                        </a>
                    </li>

                    <!-- Tampilkan nomor halaman -->
                    @for ($i = 1; $i <= $users->lastPage(); $i++)
                        <li class="page-item {{ $users->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    <!-- Tombol Next -->
                    <li class="page-item {{ $users->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $users->nextPageUrl() }}" aria-disabled="{{ $users->hasMorePages() ? 'false' : 'true' }}">
                            next
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-1"><path d="M9 6l6 6l-6 6" /></svg>
                        </a>
                    </li>
                </ul>
            </div>


        </div>
    </div>
    
</div>


    <!-- Modal Konfirmasi Hapus -->
<div class="modal modal-blur fade" id="delete-confirm-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-danger"></div>
            <div class="modal-body text-center py-4">
                <!-- Icon Danger -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-circle mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                    <path d="M12 8l0 4" />
                    <path d="M12 16l.01 0" />
                </svg>
                <h3>Are you sure?</h3>
                <div class="text-secondary">Do you really want to delete this user? This action cannot be undone.</div>
            </div>
            <div class="modal-footer">
                <div class="w-100">
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn w-100" data-bs-dismiss="modal">
                                Cancel
                            </button>
                        </div>
                        <div class="col">
                            <button type="button" id="confirm-delete-button" class="btn btn-danger w-100">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Variabel untuk menyimpan ID form yang akan di-submit
        let deleteFormId;
    
        // Ketika tombol "Delete" di modal diklik
        document.getElementById('confirm-delete-button').addEventListener('click', function() {
            if (deleteFormId) {
                document.getElementById(deleteFormId).submit(); // Submit form
            }
        });
    
        // Ketika tombol "Delete" di card user diklik
        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function() {
                deleteFormId = this.getAttribute('data-form-id'); // Simpan ID form
            });
        });
    });
</script>


        <!-- Modal Tabler -->
        <div class="modal modal-blur fade" id="imageModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <!-- Gambar yang akan ditampilkan di modal -->
                        <img id="modalImage" src="" alt="Zoomed Image" class="img-fluid rounded">
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Fungsi untuk mengatur gambar di modal
            function setModalImage(imageUrl) {
                document.getElementById('modalImage').src = imageUrl;
            }
        </script>
        <!-- Modal Tabler -->

        {{-- untuk Pencarian dengan nama user --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('search-user');
                const userCards = document.querySelectorAll('.col-md-6.col-lg-3'); // Seleksi semua card user
            
                searchInput.addEventListener('input', function() {
                    const searchTerm = this.value.trim().toLowerCase(); // Ambil nilai input dan ubah ke lowercase
            
                    userCards.forEach(card => {
                        const userName = card.querySelector('h3 a').textContent.toLowerCase(); // Ambil nama user
                        if (userName.includes(searchTerm)) {
                            card.style.display = ''; // Tampilkan card jika nama cocok
                        } else {
                            card.style.display = 'none'; // Sembunyikan card jika nama tidak cocok
                        }
                    });
                });
            });
        </script>
        {{-- untuk Pencarian dengan nama user --}}

        <style>
    /* Tombol Primary Custom — untuk New User & Edit */
    .btn-custom-primary {
        background-color: #51A49A !important;
        border-color: #51A49A !important;
        color: white !important;
    }
    .btn-custom-primary:hover {
        background-color: #428a7f !important;
        border-color: #428a7f !important;
    }
    .btn-custom-primary:focus {
        box-shadow: 0 0 0 0.2rem rgba(81, 164, 154, 0.5) !important;
    }

    /* Tombol Danger Custom — untuk Delete */
    .btn-custom-danger {
        background-color: #e53e3e !important; /* tetap merah untuk delete */
        border-color: #e53e3e !important;
        color: white !important;
    }
    .btn-custom-danger:hover {
        background-color: #c53030 !important;
        border-color: #c53030 !important;
    }
    .btn-custom-danger:focus {
        box-shadow: 0 0 0 0.2rem rgba(229, 62, 62, 0.5) !important;
    }

    /* Optional: jika ingin tombol delete juga pakai tema (tidak disarankan karena delete = danger) */
    /*
    .btn-custom-danger {
        background-color: #51A49A !important;
        border-color: #51A49A !important;
        color: white !important;
    }
    .btn-custom-danger:hover {
        background-color: #428a7f !important;
        border-color: #428a7f !important;
    }
    */
</style>
