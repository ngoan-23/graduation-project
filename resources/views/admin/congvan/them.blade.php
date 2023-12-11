@extends('admin.layout.index')
@section('title')
Thêm Công Văn
@endsection
@section('content')

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Công văn
                            <small>thêm</small>
                        </h1>
                    </div>
                    @if(count($errors)>0)
                            <div class="alert-danger">
                                @foreach($errors->all() as $err)
                                    {{ $err }}<br>
                                @endforeach
                            </div>
                    @endif
                    @if(session('loi'))
                        <div class="alert alert-danger">
                            {{ session('loi') }}
                        </div>

                    @endif
                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{ session('thongbao') }}
                        </div>

                    @endif
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="admin/congvan/them" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label>Cơ quan ban hành</label>
                                <select class="form-control" name="CoQuanBanHanh">
                                    @foreach($coquanbanhanh as $cqbh)
                                        <option value="{{ $cqbh->id }}"
                                            @if($cqbh->name == 'Sở y tế')
                                                selected
                                            @endif
                                            >{{ $cqbh->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Hình thức văn bản</label>
                                <select class="form-control" name="HinhThucVanBan">
                                    @foreach($hinhthucvanban as $htvb)
                                        <option value="{{ $htvb->id }}">{{ $htvb->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Lĩnh vực</label>
                                <select class="form-control" name="LinhVuc">
                                    @foreach($linhvuc as $lv)
                                        <option value="{{ $lv->id }}">{{ $lv->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Loại hình công văn</label>
                                <select class="form-control" name="LoaiHinhCongVan" id="loaihinhcongvan">
                                    <option value="">Chọn loại hình công văn</option>
                                    @foreach($loaihinhcongvan as $lhcv)
                                        <option value="{{ $lhcv->id }}" {{ request()->LoaiHinhCongVan == $lhcv->id ? 'selected' : '' }}>{{ $lhcv->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="phongbanSelect" class="form-group" style="display: none;">
                                <label>Phòng ban</label>
                                <select class="form-control" name="PhongBan">
                                    <option value="">Chọn phòng ban</option>
                                    @foreach($dsphongban as $phongban)
                                        <option value="{{$phongban->id }}">{{ $phongban->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Loại văn bản</label>
                                <select class="form-control" name="LoaiVanBan">
                                    @foreach($loaivanban as $lvb)
                                        <option value="{{ $lvb->id }}">{{ $lvb->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Số hiệu</label>
                                <input class="form-control" name="sohieu" value="{{ request()->sohieu ?? old('sohieu')}}" placeholder="Nhập số hiệu" />
                            </div>
                            <div class="form-group">
                                <label>Trích yếu nội dung</label>
                                <textarea class="form-control" name="trichyeunoidung" value="{{ request()->trichyeunoidung ?? old('trichyeunoidung')}}" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Người ký</label>
                                {{-- <input class="form-control" name="nguoiky"  maxlength="30" placeholder="Nhập họ và tên người ký" /> --}}
                                <select class="form-control" name="nguoiky">
                                    <option value="">Chọn người ký</option>
                                    @foreach($ds_admin as $admin)
                                        <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Ngày lập</label>
                                <input type="date" class="form-control" value="{{ request()->ngaylap ?? old('ngaylap')}}" name="ngaylap"  />
                            </div>
                            <div class="form-group">
                                <label>Ngày ký</label>
                                <input type="date" class="form-control" value="{{ request()->ngayky ?? old('ngayky')}}" name="ngayky"  />
                            </div>
                            <div class="form-group">
                                <label>Ngày hiệu lực</label>
                                <input type="date" class="form-control" value="{{ request()->ngayhieuluc ?? old('ngayhieuluc')}}" name="ngayhieuluc"  />
                            </div>
                            <div class="form-group">
                                <label>Ngày chuyển</label>
                                <input type="date" class="form-control" value="{{ request()->ngaychuyen ?? old('ngaychuyen')}}" name="ngaychuyen"  />
                            </div>
                            <div id="congkhai_congvan"  class="form-group">
                                <label>Công khai</label>
                                <label class="radio-inline">
                                    <input name="congkhai" value="1" checked="" type="radio">Có
                                </label>
                                <label class="radio-inline">
                                    <input name="congkhai" value="0" type="radio">Không
                                </label>
                            </div>
                            <div class="form-group">
                                <label>Tập tin đính kèm</label>
                                <input type="file" name="taptindinhkem">
                            </div>
                            <button type="submit" class="btn btn-default">Thêm</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                            <a href="/admin/congvan/danhsach" class="btn btn-danger">Hủy</a>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

        <!-- Xử lý ẩn hiện input chọn phòng ban và radio chọn public công văn -->
        <script>
            $(document).ready(function() {
                $('#congkhai_congvan').hide();
                // Check for jQuery existence
                if (typeof $ === 'undefined') {
                    console.error('jQuery is not loaded.');
                    return;
                }
        
                // Check if the element exists
                var loaihinhcongvanSelect = $('#loaihinhcongvan');
                if (loaihinhcongvanSelect.length === 0) {
                    console.error('#loaihinhcongvan not found.');
                    return;
                }
        
                // Check if the change event is triggered
                loaihinhcongvanSelect.change(function() {
                    var selectedValue = $('#loaihinhcongvan option:selected').val();
                    var showPhongBan = selectedValue == 2 || selectedValue == 3;

                    if (showPhongBan) {
                        $('#phongbanSelect').show();
                        $('#congkhai_congvan').show();
                    } else {
                        $('#phongbanSelect').hide();
                        $('#congkhai_congvan').hide();
                    }
                });
            });
        </script>
        
@endsection
