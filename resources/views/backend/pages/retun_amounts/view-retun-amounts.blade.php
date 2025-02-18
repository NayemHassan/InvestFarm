@extends('backend.admin.main_dashboard')
@section('content')

<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Collection  Amount</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">View Collection</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            <a type="button" href="{{route('return.amounts')}}" class="btn btn-primary" >Collection Amount Add</a>
        </div>
    </div>
</div>
<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example2" class="table table-striped table-bordered">
								<thead>
									<tr>
                                        <th>SI</th>
										<th>Investment Name</th>
										<th>Latest Update Date</th>
                                        <th>Total Investment</th>
                                        <th>Total Sales</th>
										<th>Collected Amount</th>                      
										<th>Due Profit Amount</th>                      
									</tr>
								</thead>
								<tbody>
                                 @foreach($returnAmounts as $key => $returnAmount)
                                    <tr>
                                        <td>{{ $key+1}}</td>
                                        <td>{{ $returnAmount->sales->investments->type ?? 'N/A'}}</td>
                                        <td>{{ \Carbon\Carbon::parse($returnAmount->date)->format('j F Y') ?? 'N/A' }}</td>
                                        <td>{{ $returnAmount->sales->investments->amount ?? 'N/A'}}</td>
                                        <td>{{ $returnAmount->sales->amount ?? 'N/A'}}</td>
                                        <td>{{ $returnAmount->amount ?? 'N/A' }}</td>
                                        <td>@if(($returnAmount->sales->investments->amount - $returnAmount->amount) > 0 ) 
                                         {{$returnAmount->sales->investments->amount - $returnAmount->amount ?? 0 }} Due
                                            @else
                                          {{ -($returnAmount->sales->investments->amount - $returnAmount->amount) ?? 0}} Profit
                                            @endif
                                        </td>
                                   </tr>
                                    @endforeach
							
								</tbody>
								<tfoot>
									<tr>
                                        <th>SI</th>
										<th>Investment Name</th>
										<th>Latest Update Date</th>
                                        <th>Total Investment</th>
                                        <th>Total Sales</th>
										<th>Collected Amount</th>                      
										<th>Due Profit Amount</th>                     
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
                <script>
    function confirmDelete(form) {
        event.preventDefault();
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }
</script>
         
	
@endsection