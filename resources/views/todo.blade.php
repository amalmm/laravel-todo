<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>laravel todo</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<!-- CSS only -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<!-- JavaScript Bundle with Popper -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
		<style type="text/css">
			.pagination {
		display: -ms-flexbox;
		flex-wrap: wrap;
		display: flex;
		padding-left: 0;
		list-style: none;
		border-radius: 0.25rem;
		}
		</style>
	</head>
	<body class="bg-light pt-2" style="
		background: #D3CCE3;  /* fallback for old browsers */
		background: -webkit-linear-gradient(to right, #E9E4F0, #D3CCE3);  /* Chrome 10-25, Safari 5.1-6 */
		background: linear-gradient(to right, #E9E4F0, #D3CCE3); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
		">
		<div class="container bg-white p-4  my-5 py-2 shadow-sm " style="max-width:320px;
			border: 5px solid black; border-radius:30px 30px  ; min-height: 500px;">
			<div class="row">
				<div class="col-12">
					<h3 class="mt-3">Todo</h3>
					<p style="font-weight: 500;">{{count($post)}} Tasks</p>
					<div>
						@if(Session::has('success'))
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							{{ Session::get('success') }}
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
						@endif
					</div>
					<div>
						@if ($errors->any())
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<ul style="list-style-type:none;">
								@foreach ($errors->all() as $error)
								<li class="" >{{ $error }}</li>
								@endforeach
							</ul>
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
						@endif
					</div>
				</div>
				<div class="col-12  mb-2">
					<form action="{{route('todo.store')}}" method="post" class="d-flex">
						@csrf
						<input type="text" name="name" class="form-control" value="{{ old('title') }}">
						<input type="submit" name="Todo" value="+" class="btn btn-light text-success rounded">
					</form>
				</div>
				<div class="col-12">
					<ul class="list-group">
						@if(count($post)==0)
						<li class="list-group-item disabled">create todo</li>
						<li class="list-group-item disabled">....</li>
						<li class="list-group-item disabled">....</li>
						<li class="list-group-item disabled">....</li>
						<li class="list-group-item disabled">....</li>
						<li class="list-group-item disabled"></li>
						<li class="list-group-item disabled"></li>
						<li class="list-group-item disabled"></li>
						<li class="list-group-item disabled"></li>
						@endif
						@foreach($post as $posts)
						<li class="list-group-item d-flex  justify-content-between">
							<small>
							#{{$posts->id}} :	{{$posts->name}}
							</small>
							<div class="d-flex">
								
								<div>
									<!-- Button trigger modal -->
									<button type="button" class="btn btn-sm text-primary m-0" data-bs-toggle="modal" data-bs-target="#exampleModal{{$posts->id}}">
									<i class="fa fa-edit"></i>
									</button>
									<!-- Modal -->
									<div class="modal fade" id="exampleModal{{$posts->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
												</div>
												<div class="modal-body">
													<form action="{{route('todo.update',$posts->id)}}" method="post" class="d-flex">
														@csrf
														@method('put')
														<input type="text" name="name" value="{{$posts->name}}" class="form-control">
														<input type="submit" name="Todo" value="edit" class="btn btn-light text-primary rounded">
													</form>
												</div>
												
											</div>
										</div>
									</div>
								</div>
								<div>
									<form action="{{route('todo.destroy',$posts->id)}}" method="post" class="d-flex">
										@csrf
										@method('delete')
										<!-- <input type="submit" name="Todo"  value="D" class="btn btn-sm  text-danger m-0"> -->
										<button class="btn btn-sm m-0"><i class="fa fa-close"></i></button>
									</form>
								</div>
							</div>
						</li>
						@endforeach
					</ul>
					<div class="mt-4">
						{{ $post->links() }}
					</div>
				</div>
			</div>
			<div class="text-center">
				<small >created by amal</small>
			</div>
		</div>
	</body>
</html>