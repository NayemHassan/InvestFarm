@extends('backend.admin.main_dashboard')
@section('content')

<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Sales</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Edit Sales</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            <a type="button" href="{{ route('sales.view') }}" class="btn btn-primary">View Sales</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col col-md-12 mx-auto">
        <div class="card">
            <div class="card-body">
                <div class="card-title mb-4">
                    <h5 class="mb-0">Edit Sales</h5>
                </div>
                <div class="row row-cols-auto g-3">
                    <div class="col-12">
                        <!-- Form for editing sales -->
                        <form class="row g-3" action="{{ route('sales.update', $sale->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="inputFirstName" class="form-label">Select Investments</label>
                                    <select name="investment_id" class="form-control">
                                        <option value="">Select an Investment</option>
                                        @foreach ($investments as $investment)
                                            <option value="{{ $investment->id }}" 
                                                @if($investment->id == $sale->investment_id) selected @endif>
                                                {{ $investment->type }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('investment_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="inputLastName" class="form-label">Date</label>
                                    <input type="text" name="date" class="form-control datepicker" value="{{ old('date', $sale->date) }}" />
                                    @error('date')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="inputLastName" class="form-label">Amount</label>
                                    <input type="number" class="form-control" name="amount" value="{{ old('amount', $sale->amount) }}">
                                    @error('amount')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-12 pb-2">
                                    <label for="inputAddress" class="form-label">Details</label>
                                    <textarea class="form-control" name="details" placeholder="Details..." rows="3">{{ old('details', $sale->details) }}</textarea>
                                    @error('details')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Update Sales</button>
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
