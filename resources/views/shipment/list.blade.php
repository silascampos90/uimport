@include('templates/head');
@include('templates/menu');

<!--CONTAINER -->
<div class="page-wrapper">
	<div class="page-content">
		<div class="row">
			<div class="col-12 col-lg-12">
				<div class="card">
					<div class="card-body">
						<table id="example2" class="table table-striped table-bordered">
							<colgroup>
								<col span="1" style="width: 5%;">
								<col span="1" style="width: 50%;">
								<col span="1" style="width: 15%;">
								<col span="1" style="width: 10%;">
								<col span="1" style="width: 10%;">
								<col span="1" style="width: 10%;">
							</colgroup>
							<thead>
								<tr>
									<th>Id</th>
									<th>Name</th>
									<th>Date</th>
									<th>Size</th>
									<th>Status</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@foreach($filesShipment as $fs)
								<tr>
									<th scope="row">{{ $fs->id }}</th>
									<td>{{ $fs->name }}</td>
									<td>{{ $fs->date_import }}</td>
									<td>{{ $fs->size }} mb</td>
									<td>{{ $fs->status_id }}</td>
									<td></td>
								</tr>
								@endforeach
							</tbody>
							<tfoot>
								<tr>
									<th>Id</th>
									<th>Name</th>
									<th>Date</th>
									<th>Size</th>
									<th>Status</th>
									<th></th>
								</tr>
							</tfoot>
						</table>
						{!! $filesShipment->links() !!}
					</div>
				</div>
			</div>
		</div>

	</div>
</div>


<!--CONTAINER -->

@include('templates/footer');


<script src="{{route('home')}}/assets/js/list.js"></script>