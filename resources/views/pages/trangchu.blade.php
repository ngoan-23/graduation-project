	@extends('layout.index')
	@section('title')
	Trang chủ
	@endsection

	@section('content')
	<!-- Content -->
	<div class="col-md-9">

		<div class="panel-heading" style="background-color:#337AB7; color:white;" >
			<h2 style="margin-top:0px; margin-bottom:0px;">Danh sách công văn</h2>
		</div>
		<table class="table table-striped table-bordered table-hover" id="">
			<thead>
				<tr align="center">
					<th>STT</th>
					<th>Số hiệu</th>
					<th>Ngày ký</th>
					<th>Trích yếu nội dung</th>
					@if(Auth::user())
						<th>Loại hình công văn</th>
					@endif
					<th>Cơ quan ban hành</th>
					<th>Hình thức văn bản</th>
					<th>Lĩnh vực</th>
					<th>Loại văn bản</th>
					@if(Auth::user())
						<th>Người ký</th>
					@endif
					<th>Nội dung</th>
					<th>Tải về</th>
				</tr>
			</thead>
			<tbody>


				{{-- Kiểm tra dữ liệu của bảng nếu k có thì in ra Bảng hiện có dữ liệu --}}
				@if(count($congvantrangchu) == 0)
				<tr>Bảng hiện tại chưa có dữ liệu</tr>
				@endif

				<?php
					//Cách xuất STT
					$i = 1;
					if (isset($_GET['page']) && $_GET['page'] > 1) {
						$i = (($_GET['page'] - 1) * 10) + 1;
					}
				?>
				@foreach($congvantrangchu as $cv)
					@if(Auth::user())
						<tr class="odd gradeX" align="center">
							<td>{{ $i }}</td>
							<td>{{ $cv->sohieu }}</td>
							<td>{{ Carbon\Carbon::parse($cv->ngayky)->format('d/m/Y') }}</td>
							<td><a href="chitiet/{{ $cv->id }}">{{ $cv->trichyeunoidung }}</a></td>
							<td>{{ $cv->loaihinhcongvan->name }}</td>
							<td>{{ $cv->coquanbanhanh->name }}</td>
							<td>{{ $cv->hinhthucvanban->name }}</td>
							<td>{{ $cv->linhvuc->name }}</td>
							<td>{{ $cv->loaivanban->name }}</td>
							<td>{{ $cv->nguoiky}}</td>
							<td>
								<a href="{{ asset('storage/'. $cv->tentaptindinhkem) }}" target="_blank">
									<i class="fa fa-eye fa-fw"> </i>
								</a>
							</td>
							<td>
								<a href="download/{{ $cv->id }}">
									<div  class="glyphicon glyphicon-download-alt"></div>
								</a>
							</td>
							<?php $i++;?>
						</tr>
					@else
						<tr class="odd gradeX" align="center">
							<td>{{ $i }}</td>
							<td>{{ $cv->sohieu }}</td>
							<td>{{ Carbon\Carbon::parse($cv->ngayky)->format('d/m/Y') }}</td>
							<td><a href="chitiet/{{ $cv->id }}">{{ $cv->trichyeunoidung }}</a></td>
							<td>{{ $cv->coquanbanhanh->name }}</td>
							<td>{{ $cv->hinhthucvanban->name }}</td>
							<td>{{ $cv->linhvuc->name }}</td>
							<td>{{ $cv->loaivanban->name }}</td>
							<td>
								<a href="{{ asset('storage/'. $cv->tentaptindinhkem) }}" target="_blank">
									<i class="fa fa-eye fa-fw"> </i>
								</a>
							</td>
							<td>
								<a href="/download/{{ $cv->id }}">
									<div  class="glyphicon glyphicon-download-alt"></div>
								</a>
							</td>
							<?php $i++;?>
						</tr>
					@endif
				@endforeach
			</tbody>
		</table>
		{{ $congvantrangchu->appends(request()->all())->links() }} 
	</div>
	<!-- end Page Content -->
	@endsection

