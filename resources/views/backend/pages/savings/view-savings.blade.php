@extends('backend.admin.main_dashboard')
@section('content')

<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Savings</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">View Savings</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            <a type="button" href="{{route('savings')}}" class="btn btn-primary" >Add Saving </a>
        </div>
    </div>
</div>
<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example2" class="table table-striped table-bordered">
								<thead>
									<tr><th>SI</th>
										<th>Member Name</th>
										<th>Month</th>
										<th>Amount</th>
										<th>Note</th>
                                        <th>Action</th>
									</tr>
								</thead>
								<tbody>
                                 @foreach($savings as $key => $Saving)
                                    <tr>
                                        <td>{{ $key+1}}</td>
                                        <td>{{ $Saving->member->name ?? 'N/A'}}</td>
                                        <td>{{ \Carbon\Carbon::parse($Saving->month)->format('j F Y') ?? 'N/A' }}</td>

                                        <td>{{ $Saving->amount ?? 'N/A' }}</td>
                                        <td>{{ $Saving->note  ?? 'N/A'}}</td>
                                        <td>
                                            <a class="btn btn-info" href="{{ route('savings.edit', $Saving->id) }}">Edit</a>
                                            <form action="{{ route('savings.delete', $Saving->id) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete(this);">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>

                               
                                    </tr>
                                    @endforeach
							
								</tbody>
								<tfoot>
									<tr>
                                        <th>Name</th>
										<th>Phone</th>
										<th>Photo</th>
										<th>Details</th>
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