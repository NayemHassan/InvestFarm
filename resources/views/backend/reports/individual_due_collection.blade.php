@extends('backend.admin.main_dashboard')

@section('content')

<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Collection Due Report</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Collection Due Report</li>
            </ol>
        </nav>
    </div>
</div>

<div class="col-md-6 mb-2"> 
    <label for="sale_id" class="form-label">Select Investments</label><span class="text-danger">*</span> 

    <select name="sale_id" class="form-control" id="sale_id">
        <option value="">All Investments</option>
        @foreach ($sales as $sale)
            <option value="{{ $sale->id }}">
                {{ $sale->investments->type }}
            </option>
        @endforeach
    </select>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example2" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>SI</th>
                        <th>Member Name</th>
                        <th>Investment Name</th>
                        <th>Date</th>
                        <th>Main Amount</th>
                        <th>Paid Amount</th>
                        <th>Due Amount</th>
                        <th>Note</th>
                    </tr>
                </thead>
                <tbody>
        
                    @foreach($asignSaleAmounts as $key => $asignSaleAmount)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{!! $asignSaleAmount->member->name ?? '<span class="text-danger">' . $asignSaleAmount->member_id . '</span>' !!}</td>
                            <td>{{ $asignSaleAmount->sales->investments->type ?? 'N/A' }}</td>
                            <td>{{ \Carbon\Carbon::parse($asignSaleAmount->date)->format('j F Y') ?? 'N/A' }}</td>
                            <td>{{ $asignSaleAmount->old_amount ?? 0 }}</td>
                            <td class="text-success">{{ $asignSaleAmount->old_amount - $asignSaleAmount->amount ?? 0 }}</td>
                            <td class="text-danger">{{ $asignSaleAmount->amount ?? 0 }}</td>
                            <td>{{ $asignSaleAmount->note ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                 
                </tfoot>
            </table>
        </div>
    </div>
</div>

<script>
   $(document).ready(function(){
        function loadData(sale_id = '') {
            console.log("Request Sending with Sale ID: ", sale_id); 

            $.ajax({
                url: '{{ route('filterSaleReport') }}',
                type: 'GET',
                data: { sale_id: sale_id },
                success: function(response) {
                    console.log("Response Received: ", response);
                    let tableBody = $('#example2 tbody');
                    tableBody.empty();

                    if (response.data.length === 0) {
                        tableBody.append('<tr><td colspan="7" class="text-center text-danger">No data found</td></tr>');
                        return;
                    }

                    $.each(response.data, function(index, item){
                        var formattedDate = item.date ? new Date(item.date).toLocaleDateString('en-GB', {
                        day: 'numeric',
                        month: 'long',
                        year: 'numeric'
                    }) : 'N/A';
                        let row = '<tr>' +
                                    '<td>' + (index + 1) + '</td>' +
                                    '<td>' + (item.member ? item.member.name : '<span class="text-danger">' + item.member_id + '</span>') + '</td>' +
                                    '<td>' + (item.sales.investments ? item.sales.investments.type : 'N/A') + '</td>' +
                                    '<td>' + formattedDate + '</td>' +
                                    '<td>' + (item.old_amount ? item.old_amount : 0) + '</td>' +
                                   '<td style="color: green;">' + ((item.old_amount && item.amount) ? (item.old_amount - item.amount) : 0) + '</td>' +
                                    '<td style="color: red;">' + (item.amount ? item.amount : 0) + '</td>' +
                                    '<td>' + (item.note ? item.note : 'N/A') + '</td>' +
                                  '</tr>';
                        tableBody.append(row);
                    });
                },
                error: function(xhr, status, error) {
                    console.log("Error: ", error); 
                }
            });
        }

        // Load all data initially
        $('#sale_id').on('change', function(){
            var sale_id = $(this).val();
            loadData(sale_id);
        });
    });
</script>

@endsection
