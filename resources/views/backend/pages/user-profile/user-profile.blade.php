@extends('backend.admin.main_dashboard')
@section('content')

				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Profile Info</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">{{$adminData->name}} | Profile</li>
							</ol>
						</nav>
					</div>
				</div>
				<!--end breadcrumb-->
				<div class="container">
					<div class="main-body">
						<div class="row">
							<div class="col-lg-4">
								<div class="card">
									<div class="card-body">
										<div class="d-flex flex-column align-items-center text-center">
											<img src="{{(!empty($adminData->photo))?url('uploads/users/'.$adminData->photo): 'No Image'}}" alt="Image" class="rounded p-1 bg-primary" width="110">
											<div class="mt-3">
												<h4>{{$adminData->name}}</h4>
												<p class="text-muted font-size-sm">{{$adminData->address}}</p>
												<p class="text-muted font-size-sm">{{$adminData->designation}}</p>
												
											</div>
										</div>
										<hr class="my-4" />
										
									</div>
								</div>
							</div>
							<div class="col-lg-8">
								<div class="card">
									<div class="card-body">
                                        <form action="{{route('admin.update.profile')}}" method="post" enctype="multipart/form-data">
                                            @csrf
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Name</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" name="name"  value="{{$adminData->name}}" />
											</div>
										</div>
									
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Email</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" name="email" class="form-control" value="{{$adminData->email}}" />
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Designation</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" name="designation" class="form-control" value="{{$adminData->designation}}" />
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Phone</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" name="phone" class="form-control" value="{{$adminData->phone}}" />
											</div>
										</div>
									
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Photo</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="file" name="photo" id="image" class="form-control" />
											</div>
										</div>
									
										<div class="row">
											<div class="col-sm-3"></div>
											<div class="col-sm-9 text-secondary">
												<input type="submit" class="btn btn-primary px-4" value="Save Changes" />
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