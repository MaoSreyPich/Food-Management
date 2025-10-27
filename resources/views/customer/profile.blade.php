@extends('layout.customer')

@section('title', 'Edit Profile')

@section('content')
<div class="container py-5" style="max-width: 700px;">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-5">
            <div class="text-center mb-4">
                <div class="position-relative d-inline-block">
                    <img src="{{ public\uploads($user->image.png ?? 'public/uploads/image.png') }}" 
                         class="rounded-circle" width="120" height="120" style="object-fit: cover;">
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        <label class="btn btn-sm btn-primary position-absolute bottom-0 end-0 rounded-circle">
                            <i class="bi bi-pencil-fill"></i>
                            <input type="file" name="profile_image" class="d-none" onchange="this.form.submit()">
                        </label>
                    </form>
                </div>
                <h3 class="fw-bold mt-3">{{ $user->name }}</h3>
                <p class="text-muted mb-0">{{ '@' . ($user->username ?? 'username') }}</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success text-center">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label>Full Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Username</label>
                    <input type="text" name="username" value="{{ old('username', $user->username) }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Phone</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Birth Date</label>
                    <input type="date" name="birth" value="{{ old('birth', $user->birth) }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Gender</label>
                    <select name="gender" class="form-select">
                        <option value="">Select Gender</option>
                        <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>

                <div class="text-center">
                    <button class="btn btn-warning px-4">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
