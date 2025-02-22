@extends('backend.admin.main_dashboard')
@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
                            <label for="inputFirstName" class="form-label">Select Sale</label><span class="text-danger">*</span> <strong>Amount: </strong> <span id="amount_display" style="font-size: 18px; font-weight: bold; color: #28a745;">0</span> TK
                            <select name="sale_id" class="form-control" id="sale_id">
                                <option value="">Select a Sale</option>
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
                        <label for="member_id" class="form-label">Select Members <span class="text-danger">*</span></label>
                        <select name="member_id" class="form-control" id="member_id">
                            <option value="">Select a Member</option>
                     
                        </select>
                        @error('member_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                        <div class="col-md-6">
                            <label for="inputLastName" class="form-label">Date <span class="text-danger">*</span> </label>
                            <input type="text" name="date" class="form-control datepicker" value="{{ old('date') }}" />
                            @error('date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="inputLastName" class="form-label">Amount <span class="text-danger">*</span> </label>
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

<script>
$(document).ready(function() {
    $('#sale_id').on('change', function() {
        let sale_id = $(this).val();
        console.log('Selected Sale ID:', sale_id);  // Debugging statement to ensure sale_id is being passed
        
        if (sale_id) {
            $.ajax({
                url: '/get-sale-amount/' + sale_id,
                type: 'GET',
                success: function(response) {
                    console.log('Server Response:', response);  // Debugging server response
                    $('#amount_display').text(response.amount);  // Display the fetched amount
                },
                error: function() {
                    $('#amount_display').text('0');  // In case of an error, show 0
                }
            });
        } else {
            $('#amount_display').text('0');  // If no sale is selected, show 0
        }
    });
  
})
$('#sale_id').on('change', function() {
    var saleId = $(this).val();
    if (saleId) {
        $.ajax({
            url: '/get-available-members/' + saleId,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                $('#member_id').empty().append('<option value="">Select a Member</option>');
                
                // availableMembers array থেকে real member options যোগ করা
                $.each(response.availableMembers, function(index, member) {
                    $('#member_id').append('<option value="' + member.id + '">' + member.name + '</option>');
                });
                
                // যদি others option এখনও অ্যাসাইন না করা থাকে, তাহলে যোগ করা
                if(response.othersAvailable){
                    $('#member_id').append('<option value="others">Others Collection</option>');
                }
                
                // যদি nagad option এখনও অ্যাসাইন না করা থাকে, তাহলে যোগ করা
                if(response.nagadAvailable){
                    $('#member_id').append('<option value="nagad">Nagad Collection</option>');
                }
            },
            error: function(xhr, status, error) {
                console.log("Error:", error);
            }
        });
    } else {
        $('#member_id').empty().append('<option value="">Select a Member</option>');
    }
});

</script>
@endsection
