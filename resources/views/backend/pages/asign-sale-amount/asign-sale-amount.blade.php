@extends('backend.admin.main_dashboard')
@section('content')

<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Assign Sales</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Assign Sales</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            <a type="button" href="{{route('assign.amount.view')}}" class="btn btn-primary" >View Assign Sales </a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col col-md-12 mx-auto">
        <div class="card">
            <div class="card-body">
                <div class="card-title mb-4">
                    <h5 class="mb-0">Assign Sales In Members</h5>
                </div>
                <div class="row row-cols-auto g-3">
                    <div class="col-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form class="row g-3" action="{{ route('assign.amount.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="inputFirstName" class="form-label">Select Sale</label>
                            <select name="sale_id" class="form-control">
                                <option value="">Select a Sales</option>
                                @foreach ($sales as $sale)
                                    <option value="{{ $sale->id }}">
                                        {{ $sale->investments->type }}
                                    </option>
                                @endforeach
                            </select>
                            @error('sale_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="inputFirstName" class="form-label">Select Members</label>
                            <select name="members_id" class="form-control">
                                <option value="">Select a Members</option>
                                @foreach ($members as $member)
                                    <option value="{{ $member->id }}" >
                                        {{ $member->name }}
                                    </option>
                                @endforeach
                                <option value="others">Others Collection</option>
                                <option value="nagad">Nagad Collection</option>
                            </select>
                            @error('members_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="inputLastName" class="form-label">Date</label>
                            <input type="text" name="date" class="form-control datepicker" value="{{ old('date') }}" />
                            @error('date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="inputLastName" class="form-label">Amount</label>
                            <input type="number" class="form-control" name="amount" value="{{ old('amount') }}">
                            @error('amount')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 pb-2">
                            <label for="inputAddress" class="form-label">Note</label>
                            <textarea class="form-control" name="note" placeholder="Note..." rows="3">{{ old('note') }}</textarea>
                            @error('note')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Save Assign Money</button>
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
