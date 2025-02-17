@extends('backend.admin.main_dashboard')
@section('content')

<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Fines</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">View Fines</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            <a type="button" href="{{route('fines')}}" class="btn btn-primary" >Add Fines </a>
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
										<th>Date</th>
										<th>Amount</th>
										<th>Reason</th>
                                        <th>Action</th>
									</tr>
								</thead>
								<tbody>
                                 @foreach($fines as $key => $fine)
                                    <tr>
                                        <td>{{ $key+1}}</td>
                                        <td>{{ $fine->member->name ?? 'N/A'}}</td>
                                        <td>{{ $fine->date ?? 'N/A'}}</td>
                                        <td>{{ $fine->amount ?? 'N/A' }}</td>
                                        <td>{{ $fine->reason  ?? 'N/A'}}</td>
                                        <td>
                                            <a class="btn btn-info" href="{{ route('fines.edit', $fine->id) }}">Edit</a>
                                            <form action="{{ route('fines.delete', $fine->id) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete(this);">
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