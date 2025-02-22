@extends('backend.admin.main_dashboard')
@section('content')

<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Users</div>
  
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">View Users</li>
            </ol>
        </nav>
    </div>
   
    @if(Auth::check() && Auth::user()->role === 'admin')
    <div class="ms-auto">
        <div class="btn-group">
            <a type="button" href="{{route('make.user')}}" class="btn btn-primary" >Add User </a>
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
										<th>Name</th>
										<th>Email</th>
										<th>Phone</th>
										<th>Photo</th>
                                        <th>Designation</th>
                                        <th>Role</th>
                                        @if(Auth::check() && Auth::user()->role === 'admin')
                                        <th>Action</th>
                                        @endif
									</tr>
								</thead>
								<tbody>
                                 @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td> @if($user->photo)
                                        <img src="{{ asset('uploads/users/' . $user->photo) }}" alt="Photo" width="50">
                                        @else
                                            No Image
                                        @endif</td>
                                        <td>{{ $user->designation }}</td>
                                        <td>{{$user->role}}</td>
                                        @if(Auth::check() && Auth::user()->role === 'admin')
                                        <td>
                                            <a class="btn btn-info" href="{{ route('user.edit', $user->id) }}">Edit</a>
                                            <form action="{{ route('user.delete', $user->id) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete(this);">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>

                                    @endif
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