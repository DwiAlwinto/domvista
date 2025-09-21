<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        @if(isset($user))
                            Edit User
                        @else
                            Create New User
                        @endif
                    </h3>
                    <div class="card-actions">
                        <a href="/admin/user" class="btn btn-green btn-sm">Back</a> <!-- Tombol kembali -->
                    </div>
                </div>
                <div class="card-body">
                    @isset($user)
                    <form action="/admin/user/{{ $user->id }}" method="POST" enctype="multipart/form-data">
                        @method('put')
                    @else
                    <form action="/admin/user" method="POST" enctype="multipart/form-data">    
                    @endisset
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter full name" value="{{ isset($user) ? $user->name : '' }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter email" value="{{ isset($user) ? $user->email : '' }}">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter password">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="Confirm password">
                            @error('password_confirmation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <select class="form-select @error('role') is-invalid @enderror" name="role">
                                <option value="" disabled>Select Role</option>
                                <option value="admin" {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="user" {{ old('role', $user->role ?? '') == 'user' ? 'selected' : '' }}>User</option>
                                <option value="manager" {{ old('role', $user->role ?? '') == 'manager' ? 'selected' : '' }}>Manager</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Profile Picture</label>
                            <input type="file" class="form-control @error('foto_profil') is-invalid @enderror" name="foto_profil">
                            @if(isset($user) && $user->foto_profil)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $user->foto_profil) }}" alt="Profile Picture" width="100">
                                </div>
                            @endif
                            @error('foto_profil')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-success">
                                @if(isset($user))
                                    Update User
                                @else
                                    Create User
                                @endif
                            </button> 
                            <a href="/admin/user" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>

                </div> <!-- Penutupan card-body -->
            </div> <!-- Penutupan card -->
            
        </div> <!-- Penutupan container-xl -->
    </div> <!-- Penutupan page-header -->
</div> <!-- Penutupan page-wrapper -->