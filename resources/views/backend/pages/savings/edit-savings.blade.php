@extends('backend.admin.main_dashboard')

@section('content')

<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Savings</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Savings</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            <a type="button" href="{{ route('savings.view') }}" class="btn btn-primary">View Savings</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col col-md-12 mx-auto">
        <div class="card">
            <div class="card-body">
                <div class="card-title mb-4">
                    <h5 class="mb-0">Edit Savings</h5>
                </div>
                <div class="row row-cols-auto g-3">
                    <div class="col-12">
                      
                    <form class="row g-3" action="{{ route('savings.update', $savings->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <label for="inputFirstName" class="form-label">Select Member</label>
                                <select name="member_id" class="form-control" disabled>
                                    @foreach ($members as $member)
                                        <option value="{{ $member->id }}" {{ $savings->member_id == $member->id ? 'selected' : '' }}>
                                            {{ $member->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="inputLastName" class="form-label">Date</label>
                                <input type="text" name="month" class="form-control datepicker" value="{{ old('month', \Carbon\Carbon::parse($savings->month)->format('Y-m-d')) }}" disabled/>
                            </div>

                            <div class="col-md-6">
                                <label for="inputLastName" class="form-label">Amount</label>
                                <input type="number" class="form-control" name="amount" value="{{ old('amount', $savings->amount) }}" disabled>
                                @error('amount')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-12 pb-2">
                                <label for="inputAddress" class="form-label">Note</label>
                                <textarea class="form-control" name="note" placeholder="Note..." rows="3">{{ old('note', $savings->note) }}</textarea>
                                @error('note')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-success">Update Savings</button>
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
