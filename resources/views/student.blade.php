<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>All Student</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- Datatables -->
	<link rel="stylesheet" href="http://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
	<link type="text/css" href='https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css' rel='stylesheet'>
	<link type="text/css" href='https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css' rel='stylesheet'>
</head>
<body>
	<section style="padding-top: 60px;">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<a href="/add-student" class="btn btn-primary"><i class="fa fa-user-plus"></i> Add</a>
						</div>
						<br>
				<!-- 		@if(Session::has('message'))
						<div class="alert alert-success" role="alert">
							{{Session::get('message')}}
						</div>
						@endif -->
						<div class="card-body">
							<h2>All Student</h2>
							<table class="display responsive nowrap" style="width:100%" id="myTable">
								<thead>
									<tr>
										<th>No</th>
										<th>Full Name</th>
										<th>E-Mail</th>
										<th>Phone Number</th>
										<th>Address</th>
										<th>Foto</th>
										<th class="text-center">Option</th>
									</tr>
								</thead>
								<tbody>
									<?php $no=1; ?>
									@foreach($student as $students)
									<tr>
										<td>{{$no++}}</td>
										<td>{{$students->name}}</td>
										<td>{{$students->email}}</td>
										<td>{{$students->phone}}</td>
										<td>{{$students->address}}</td>
										<td><img src="{{url('foto/'.$students->foto)}}" alt="" width="100" height="100" class="img-circle"></td>
										<td>
											<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit{{$students->id}}">
												<i class="fa fa-pencil"></i> Edit
											</button>
											<a href="/delete-student/{{$students->id}}" class="btn btn-danger delete-confirm"><i class="fa fa-trash"></i> Delete</a>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
							@foreach($student as $students)
							<!-- Modal Delete Siswa -->
							<div class="modal fade" id="delete{{$students->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-md">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel"> Delete Student {{$students->name}}</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											Are you sure you want to delete data by name
											<b>{{$students->name}}</b> ?
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
											<a href="/delete-student/{{$students->id}}" class="btn btn-primary">Yes Delete!</a>
										</div>
									</div>
								</div>
							</div>
							@endforeach

							<!-- Modal Edit Siswa -->
							@foreach($student as $students)
							<div class="modal fade" id="edit{{$students->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-md">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title"> Update Student {{$students->name}}</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form method="POST" action="{{route('student.update')}}" enctype="multipart/form-data">
												@csrf
												<input type="hidden" name="id" value="{{$students->id}}">
												<div class="form-group">
													<label for="name">Full Name</label>
													<input type="text" name="name" class="form-control" placeholder="Enter Full Name" value="{{$students->name}}">
												</div>
												<div class="form-group">
													<label for="email">E-Mail</label>
													<input type="email" name="email" class="form-control" placeholder="Enter Email" value="{{$students->email}}">
												</div>
												<div class="form-group">
													<label for="phone">Phone</label>
													<input type="number" name="phone" class="form-control" placeholder="Enter Phone Number" value="{{$students->phone}}">
												</div>
												<div class="form-group">
													<label for="address">Address</label>
													<textarea name="address" class="form-control" rows="3" placeholder="Enter You Address">{{$students->address}}</textarea>
												</div>
												<div class="form-group">
													<label for="foto">Foto</label>
													<input type="file" name="foto" class="form-control" value="{{old('foto')}}" onchange="previewFile(this)">
													<br>
													<img src="{{url('foto/'.$students->foto)}}" id="previewImg" alt="preview Image" style="max-width: 130px; margin-top: 20px;">
													<div class="text-danger">
														@error('foto')
														{{ $message }}
														@enderror
													</div>
												</div>
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
												<button type="submit" class="btn btn-success"><i class="fa fa-paper-plane"></i> Update Student</button>
											</form>
										</div>
									</div>
								</div>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
@if(Session::has('message'))
<script>
	swal("Mantap","{!! Session::get('message') !!}","success",{
		button:"OK",
	})
</script>
@endif
<script>
	$(document).ready(function() {
		$('#myTable').DataTable( {
			dom: 'Bfrtip',
			buttons: [
			'colvis'
			]
		} );
	} );
</script>
<!-- Alert timeout -->
<script>
	window.setTimeout(function(){
		$(".alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove();
		});
	}, 3000);
</script> 
<!-- EndAlert timeout -->
<script>
	function previewFile(input)
	{
		var file =$("input[type=file]").get(0).files[0];
		if(file)
		{
			var reader = new FileReader();
			reader.onload = function(){
				$('#previewImg').attr("src",reader.result);
			}
			reader.readAsDataURL(file);
		}
	}
</script>
<!-- Delete Data With sweetalert -->
<script>
	$('.delete-confirm').on('click', function (event) {
		event.preventDefault();
		const url = $(this).attr('href');
		swal({
			title: 'Are you sure?',
			text: 'This record and it`s details will be permanantly deleted!',
			icon: 'warning',
			buttons: ["Cancel", "Yes!"],
		}).then(function(value) {
			if (value) {
				window.location.href = url;
			}
		});
	});
</script>
</body>
</html>