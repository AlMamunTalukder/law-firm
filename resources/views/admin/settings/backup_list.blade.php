@extends('layouts.admin')
@section('title')
{{__('page.backup_list')}}
@endsection
@section('content')
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="card card-primary card-outline">
					<div class="card-header">
						<h3 class="card-title">{{__('page.backup_list')}}</h3>
						<div class="card-tools">
							<form class="validate_form" action="{{ route('admin.backup.store') }}" method="post">
								@csrf
								<button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-database"></i>&nbsp;{{__('page.create_backup')}}</button>
							</form>
						</div>
					</div>

					<div class="card-body">
						@include('shared.redirect_msg')
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>{{__('page.sl')}}</th>
									<th>{{__('page.backup_time')}}</th>
									<th>{{__('page.action')}}</th>
								</tr>
							</thead>
							<tbody id="sortable_table">
								@foreach ($files as $key=>$element)
								<tr>
									<td>{{bnNum($loop->iteration)}}</td>
									<td>{{date('d M, Y h:i a',filemtime($element['dirname'].'/'.$element['basename']))}}</td>
									<td>
										<div class="btn-group">
											<a data-bs-toggle="tooltip" data-bs-title="{{__('page.download')}} {{__('page.backup')}}" href="{{asset('storage/backup')}}/{{$element['basename']}}" class="btn-primary btn btn-sm text-white" download="Backup_{{$element['filename']}}">{{__('page.download')}}</a>
											<a class="btn-danger btn btn-sm" href="#"  onclick="event.preventDefault(); document.getElementById('delete_backup_{{$loop->iteration}}').submit();">{{__('page.delete')}}</a>
											<form id="delete_backup_{{$loop->iteration}}" action="{{ route('admin.backup.destroy',$element['basename'])}}" class="validate_form" method="POST" style="display: none;">
												@method('DELETE')
												@csrf
											</form>
										</div>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>

				</div>
			</div>

		</div>

	</div>

</div>
@endsection
