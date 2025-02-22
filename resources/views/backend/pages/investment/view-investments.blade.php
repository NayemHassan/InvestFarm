@extends('backend.admin.main_dashboard')
@section('content')

<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Investment</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">View Investment</li>
            </ol>
        </nav>
    </div>
    @if(Auth::check() && Auth::user()->role === 'admin')
    <div class="ms-auto">
        <div class="btn-group">
            <a type="button" href="{{route('investment')}}" class="btn btn-primary" >Add Investment </a>
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
										<th>Invest Type</th>
										<th>Amount</th>
										<th>Date</th>
										<th>Image</th>
										<th>Details</th>
                                        @if(Auth::check() && Auth::user()->role === 'admin')
                                        <th>Action</th>
                                        @endif
									</tr>
								</thead>
								<tbody>
                                 @foreach($investments as $investment)
                                    <tr>
                                        <td>{{ $investment->type }}</td>
                                        <td>{{ $investment->amount }}</td>
                                        <td>{{ \Carbon\Carbon::parse($investment->date)->format('j F Y') ?? 'N/A' }}</td>

                                        <td> @if($investment->image)
                                            <img src="{{ asset($investment->image) }}" alt="image" width="50">
                                        @else
                                            No Image
                                        @endif</td>
                                        <td>{{ $investment->details }}</td>
                                        @if(Auth::check() && Auth::user()->role === 'admin')
                                        <td>
                                            <a class="btn btn-info" href="{{ route('investment.edit', $investment->id) }}">Edit</a>
                                            <!-- <form action="{{ route('investment.delete', $investment->id) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete(this);">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form> -->
                                    </td>
                                    @endif
                                    </tr>
                                    @endforeach
							
								</tbody>
								<tfoot>
									<tr>
                                      <th>Invest Type</th>
										<th>Amount</th>
										<th>Date</th>
										<th>Image</th>
										<th>Details</th>
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