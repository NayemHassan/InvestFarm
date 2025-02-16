@extends('backend.admin.main_dashboard')

@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Members</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Edit Member</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            <a type="button" href="{{ route('view.member') }}" class="btn btn-primary">View Members</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col col-md-12 mx-auto">
        <div class="card">
            <div class="card-body">
            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                <div class="card-title mb-4">
                    <h5 class="mb-0">Edit Member</h5>
                </div>
                <div class="row row-cols-auto g-3">
                    <div class="col-12">
                        <form class="row g-3" action="{{ route('member.update', $member->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="inputFirstName" class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" id="inputFirstName" value="{{ $member->name }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPhone" class="form-label">Phone</label>
                                    <input type="text" class="form-control" name="phone" id="inputPhone" value="{{ $member->phone }}" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="inputPhoto" class="form-label">Photo</label>
                                    <div class="input-group mb-3">
                                        <input type="file" class="form-control" name="photo" id="inputGroupFile02">
                                        <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                    </div>
                                    @if($member->photo)
                                        <img src="{{ url($member->photo) }}" alt="Photo" width="100">
                                    @endif

                                </div>
                                <div class="col-12 pb-2">
                                    <label for="inputDescription" class="form-label">Description</label>
                                    <textarea class="form-control" id="inputDescription" name="description" rows="3">{{ $member->description }}</textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Update Member</button>
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
