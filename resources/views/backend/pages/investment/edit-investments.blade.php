@extends('backend.admin.main_dashboard')
@section('content')

<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Investment</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Investment</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            <a type="button" href="{{ route('investment.view') }}" class="btn btn-primary">View Investment</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col col-md-12 mx-auto">
        <div class="card">
            <div class="card-body">
                <div class="card-title mb-4">
                    <h5 class="mb-0">Edit Investment</h5>
                </div>
                <div class="row row-cols-auto g-3">
                    <div class="col-12">
                        <form class="row g-3" action="{{ route('investment.update', $investment->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT') <!-- This is for the PUT request to update the resource -->
                            
                            <div class="row">
                                <!-- Investment Type -->
                                <div class="col-md-6">
                                    <label for="inputFirstName" class="form-label">Investment Type Name</label>
                                    <input type="text" class="form-control" name="type" id="inputFirstName" value="{{ old('type', $investment->type) }}">
                                    @error('type')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Date -->
                                <div class="col-md-6">
                                    <label for="inputDate" class="form-label">Date</label>
                                    <input type="text" name="date" class="form-control datepicker" value="{{ old('date', $investment->date) }}" />
                                    @error('date')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Amount -->
                                <div class="col-md-6">
                                    <label for="inputAmount" class="form-label">Amount</label>
                                    <input type="number" class="form-control" name="amount" id="inputAmount" value="{{ old('amount', $investment->amount) }}" readonly>
                                    @error('amount')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Image -->
                                <div class="col-md-12">
                                    <label for="inputPhoto" class="form-label">Image</label>
                                    <div class="input-group mb-3">
                                        <input type="file" class="form-control" name="image" id="inputGroupFile02">
                                        <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                    </div>
                                    @if($investment->image)
                                        <img src="{{ asset($investment->image) }}" alt="Investment Image" width="100" />
                                    @endif
                                    @error('image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Details -->
                                <div class="col-12 pb-2">
                                    <label for="inputDescription" class="form-label">Details</label>
                                    <textarea class="form-control" id="inputDescription" name="details" placeholder="Details..." rows="3">{{ old('details', $investment->details) }}</textarea>
                                    @error('details')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Submit -->
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Update Investment</button>
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
