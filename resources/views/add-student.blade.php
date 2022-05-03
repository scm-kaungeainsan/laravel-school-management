<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Add Student</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<section style="padding-top: 60px;">
		<div class="container">
			<div class="row">
				<div class="col-md-6 offset-md-3">
					<div class="card">
						<div class="card-header">
							<i class="fa fa-graduation-cap"></i> Add Student
						</div>
						<div class="card-body">
							<form method="POST" action="{{route('student-create')}}" enctype="multipart/form-data">
								@csrf
								<div class="form-group">
									<label for="name">Full Name</label>
									<input type="text" name="name" class="form-control" placeholder="Enter Full Name" value="{{old('name')}}">
									<div class="text-danger">
										@error('name')
										{{ $message }}
										@enderror
									</div>
								</div>
								<div class="form-group">
									<label for="email">E-Mail</label>
									<input type="email" name="email" class="form-control" placeholder="Enter Email" value="{{old('email')}}">
									<div class="text-danger">
										@error('email')
										{{ $message }}
										@enderror
									</div>
								</div>
								<div class="form-group">
									<label for="phone">Phone</label>
									<input type="number" name="phone" class="form-control" placeholder="Enter Phone Number" value="{{old('phone')}}">
									<div class="text-danger">
										@error('phone')
										{{ $message }}
										@enderror
									</div>
								</div>
								<div class="form-group">
									<label for="address">Address</label>
									<textarea name="address" class="form-control" rows="3" value="{{old('address')}}" placeholder="Enter You Address"></textarea>
									<div class="text-danger">
										@error('address')
										{{ $message }}
										@enderror
									</div>
								</div>
								<div class="form-group">
									<label for="foto">Foto</label>
									<input type="file" name="foto" class="form-control" value="{{old('foto')}}" onchange="previewFile(this)">
									<br>
									<img src="{{asset('foto/default.jpg')}}" id="previewImg" alt="preview Image" style="max-width: 130px; margin-top: 20px;">
									<div class="text-danger">
										@error('foto')
										{{ $message }}
										@enderror
									</div>
								</div>
								<button type="submit" class="btn btn-success"><i class="fa fa-paper-plane"></i> Save</button>
								<a href="student" class="btn btn-secondary"><i class="fa fa-backward"></i> Back</a>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>

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
	<!-- Alert timeout -->
	<script>
		window.setTimeout(function(){
			$(".text-danger").fadeTo(500, 0).slideUp(500, function(){
				$(this).remove();
			});
		}, 3000);
	</script> 
	<!-- EndAlert timeout -->

</body>
</html>