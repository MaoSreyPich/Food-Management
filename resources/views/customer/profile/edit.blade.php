@extends('layout.customer')

@section('title', 'Edit Profile')

@push('styles')
<style>
  .profile-card {
    max-width: 520px;
    margin: 40px auto;
    background: #fff;
    border-radius: 28px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    position: relative;
    padding: 80px 40px 40px;
  }

  .profile-avatar {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    border: 6px solid #fff;
    position: absolute;
    top: -60px;
    left: 50%;
    transform: translateX(-50%);
    box-shadow: 0 6px 20px rgba(0,0,0,0.12);
    background: #eee;
  }

  .avatar-edit {
    position: absolute;
    top: -18px;
    right: calc(50% - 60px);
    transform: translateX(50%);
    background: #0d6efd;
    color: white;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.12);
    cursor: pointer;
  }

  .profile-card h3 {
    text-align: center;
    margin-top: 8px;
    margin-bottom: 24px;
    font-weight: 700;
  }

  .form-control.rounded-pill {
    border-radius: 12px;
  }

  .label-small {
    font-size: 13px;
    color: #444;
    font-weight: 600;
  }

  @media (max-width: 576px) {
    .profile-card { padding: 60px 20px 30px; }
    .profile-avatar { width: 100px; height: 100px; top: -50px; }
  }
</style>
@endpush

@section('content')
  <div class="container">
    <div class="profile-card">
      {{-- avatar --}}
      <img src="{{ $user->profile_image ? asset($user->profile_image) : 'https://via.placeholder.com/150' }}" alt="avatar" class="profile-avatar">

      <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="text-center mb-3">
          <h3>Edit Profile</h3>
        </div>

        <div class="mb-3 text-center">
          <label class="avatar-edit" title="Change avatar">
            <i class="fa fa-pen"></i>
            <input type="file" name="profile_image" accept="image/*" style="display:none" onchange="this.form.submit()">
          </label>
        </div>

        <div class="row g-3">
          <div class="col-12 col-sm-6">
            <label class="label-small">First Name</label>
            <input type="text" name="name" class="form-control rounded-pill" value="{{ old('name', $user->name) }}" required>
          </div>

          <div class="col-12 col-sm-6">
            <label class="label-small">Last Name</label>
            {{-- If your User model doesn't have first/last split, keep last name in username field or customize as needed --}}
            <input type="text" name="last_name" class="form-control rounded-pill" value="{{ old('last_name', $user->last_name ?? '') }}">
          </div>

          <div class="col-12">
            <label class="label-small">Username</label>
            <input type="text" name="username" class="form-control rounded-pill" value="{{ old('username', $user->username) }}">
          </div>

          <div class="col-12">
            <label class="label-small">Email</label>
            <input type="email" name="email" class="form-control rounded-pill" value="{{ old('email', $user->email) }}" required>
          </div>

          <div class="col-12">
            <label class="label-small">Phone Number</label>
            <input type="text" name="phone" class="form-control rounded-pill" value="{{ old('phone', $user->phone) }}">
          </div>

          <div class="col-12 col-sm-6">
            <label class="label-small">Birth</label>
            <input type="date" name="birth" class="form-control rounded-pill" value="{{ old('birth', optional($user->birth)->format('Y-m-d') ?? $user->birth) }}">
          </div>

          <div class="col-12 col-sm-6">
            <label class="label-small">Gender</label>
            <select name="gender" class="form-select rounded-pill">
              <option value="">Choose</option>
              <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Male</option>
              <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Female</option>
              <option value="other" {{ old('gender', $user->gender) == 'other' ? 'selected' : '' }}>Other</option>
            </select>
          </div>

          <div class="col-12 text-center mt-3">
            <button class="btn btn-primary rounded-pill px-5">Save Changes</button>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection
