@extends('backend.admin.main_dashboard')
@section('content')

<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Collection Amounts</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Add Collection Amounts</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            <a type="button" href="{{route('return.amounts.view')}}" class="btn btn-primary" >View Collection Amounts </a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col col-md-12 mx-auto">
        <div class="card">
            <div class="card-body">
                <div class="card-title mb-4">
                    <h5 class="mb-0">Entry Collection Amounts</h5>
                </div>
                <div class="row row-cols-auto g-3">
                    <div class="col-12">
                      
                    <form class="row g-3" action="{{ route('return.amounts.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label for="inputFirstName" class="form-label">Select Sales <span class="text-danger">*</span></label>
                            <select name="sale_id"  id="sale_id" class="form-control">
                                <option value="">Select a Sales</option>
                                @foreach ($sales as $sale)
                                    <option value="{{ $sale->id }}" >
                                        {{ $sale->investments->type }}
                                    </option>
                                @endforeach
                            </select>
                            @error('sale_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="inputFirstName" class="form-label">Select Collected Member <span class="text-danger">*</span>  <span  id="remainingAmount"></span></label>
                            <select name="member_id"  id="member_id"  class="form-control">
                                <option value="">Select a Member</option>
                            </select>
                            @error('member_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="inputLastName" class="form-label">Date <span class="text-danger">*</span></label>
                            <input type="text" name="date" class="form-control datepicker" value="{{ old('date') }}" />
                            @error('date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="inputLastName" class="form-label">Amount <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="amount" value="{{ old('amount') }}">
                            @error('amount')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-12 mb-2">
                            <label for="inputAddress" class="form-label">Note</label>
                            <textarea class="form-control" name="note" placeholder="Note..." rows="3">{{ old('note') }}</textarea>
                          
                        </div>


                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Save Sales</button>
                        </div>
                    </div>
                </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // যখন Sale সিলেক্ট করা হবে, তখন মেম্বার লোড হবে
        $('#sale_id').on('change', function() {
            var saleId = $(this).val();
            
            if (saleId) {
                $.ajax({
                    url: '/get-members/' + saleId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        $('#member_id').empty().append('<option value="">Select a Member</option>');
                        $.each(response, function(index, member) {
                            let memberName = member.member ? member.member.name : member.member_id;
                            $('#member_id').append('<option value="' + member.member_id + '">' + memberName+ '</option>');
                        });
                    }
                });
            } else {
                $('#member_id').empty().append('<option value="">Select a Member</option>');
            }
        });
         // যখন Member সিলেক্ট করা হবে, তখন Remaining Amount লোড হবে
         $('#member_id').on('change', function() {
            let saleId = $('#sale_id').val();
            let memberId = $(this).val();
            if (saleId && memberId) {
                $.ajax({
                    url: '/get-remaining-amount/' + saleId + '/' + memberId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                
                    $('#remainingAmount').html(' | Remaining Amount: <span style="font-size: 18px; font-weight: bold; color: green;">' + response.payments[memberId] + '</span>');
                    },
                    error: function(xhr, status, error) {
                        console.log("Error:", error);
                    }
                });
            } else {
                $('#remainingAmount').val('');
            }
                });
    });
</script>

@endsection
