@extends('backend.admin.main_dashboard')
@section('content')

<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Edit User</div>
    @if(Auth::check() && Auth::user()->role === 'admin')

    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Edit User</li>
            </ol>
        </nav>
    </div>

    @endif
    <div class="ms-auto">
        <div class="btn-group">
            <a type="button" href="{{route('view.users')}}" class="btn btn-primary">View Users</a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col col-md-12 mx-auto">
        <div class="card">
            <div class="card-body">
                <div class="card-title mb-4">
                    <h5 class="mb-0">Edit User</h5>
                </div>
                <div class="row row-cols-auto g-3">
                    <div class="col-12">
                        <form class="row g-3" action="{{ route('update.user', $user->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT') <!-- Use PUT method for update -->

                            <div class="row">
                                <!-- Name -->
                                <div class="col-md-6">
                                    <label for="inputFirstName" class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" id="inputFirstName" value="{{ $user->name }}">
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="col-md-6">
                                    <label for="inputEmail" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="inputEmail" value="{{ $user->email }}">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Phone -->
                                <div class="col-md-6">
                                    <label for="inputPhone" class="form-label">Phone</label>
                                    <input type="text" class="form-control" name="phone" id="inputPhone" value="{{ $user->phone }}">
                                    @error('phone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Photo -->
                                <div class="col-md-6">
                                    <label for="inputPhoto" class="form-label">Photo</label>
                                    <div class="input-group mb-3">
                                        <input type="file" class="form-control" name="photo" id="inputGroupFile02">
                                        <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                    </div>
                                    @if($user->photo)
                                        <div class="mt-2">
                                        <img src="{{ asset('uploads/users/' . $user->photo) }}" alt="Photo" width="50">

                                        </div>
                                    @endif
                                    @error('photo')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Role -->
                                <div class="col-md-6">
                                    <label for="inputRole" class="form-label">Role</label>
                                    <select class="form-control" name="role" id="inputRole">
                                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                    </select>
                                    @error('role')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Designation -->
                                <div class="col-6 mb-2">
                                    <label for="inputDescription" class="form-label">Designation</label>
                                    <textarea class="form-control" id="inputDescription" name="designation" placeholder="Designation..." rows="3">{{ $user->designation }}</textarea>
                                    @error('designation')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Password (Optional) -->
                                <div class="col-md-12 mb-2">
                                    <label for="inputPassword" class="form-label">Password (Leave blank to keep current password)</label>
                                    <input type="password" class="form-control" name="password" id="inputPassword">
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Submit -->
                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary">Update User</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection