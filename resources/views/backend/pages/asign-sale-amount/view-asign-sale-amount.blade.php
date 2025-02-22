@extends('backend.admin.main_dashboard')
@section('content')

<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">View Assign Amount</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">View Assign  Collection</li>
            </ol>
        </nav>
    </div>
    @if(Auth::check() && Auth::user()->role === 'admin')
                                      
    <div class="ms-auto">
        <div class="btn-group">
            <a type="button" href="{{route('assign.amount')}}" class="btn btn-primary" >Add Assign Money </a>
        </div>
    </div>

    @endif
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
										<th>Due Amount</th>
										<th>Note</th>
                                        @if(Auth::check() && Auth::user()->role === 'admin')
                                        <th>Action</th>
                                        @endif
									</tr>
								</thead>
								<tbody>
                                 @foreach($asignSaleAmounts as $key => $asignSaleAmount)
                                    <tr>
                                        <td>{{ $key+1}}</td>
                                        <td>{!! $asignSaleAmount->member->name ?? '<span class="text-danger">' . $asignSaleAmount->member_id . '</span>' !!}</td>

                                        <td>{{ $asignSaleAmount->sales->investments->type ?? 'N/A'}}</td>
                                        <td>{{ \Carbon\Carbon::parse($asignSaleAmount->date)->format('j F Y') ?? 'N/A' }}</td>
                                        <td>{{ $asignSaleAmount->old_amount ?? 0 }}</td>
                                        <td>{{ $asignSaleAmount->amount ?? 0 }}</td>
                                        <td>{{ $asignSaleAmount->note  ?? 'N/A'}}</td>
                                        @if(Auth::check() && Auth::user()->role === 'admin')
                                       
                                        <td>
                                            <a class="btn btn-info" href="{{ route('assign.amount.edit', $asignSaleAmount->id) }}">Edit</a>
                                          
                                    </td>

                                 
                                    @endif
                                    </tr>
                                    @endforeach
							
								</tbody>
								<tfoot>
									<tr>
                                    <th>SI</th>
                                    <th>Member Name</th>

										<th>Investment Name</th>
										<th>Date</th>
                                        <th>Old Amount</th>
										<th>Updated Amount</th>
										<th>Note</th>
                                        @if(Auth::check() && Auth::user()->role === 'admin')
                                        <th>Action</th>
                                        @endif
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