@extends('admin.layout.index')
@section('title')
Thêm Người dùng
@endsection
@section('content')

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Người dùng
                            <small>thêm</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $err )
                                    {{ $err }}<br>
                                @endforeach
                            </div>
                        @endif

                        @if(session('thongbao'))
                            <div class="alert alert-success">{{ session('thongbao') }}</div>
                        @endif
                        <form action="admin/user/them" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label>Tên người dùng</label>
                                <input class="form-control" name="name" placeholder="Nhập tên người dùng" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" name="email" type="email" required placeholder="Nhập email người dùng" />
                            </div>
                            <div class="form-group">
                                <label>Quyền</label>
                                <select class="form-control" name="level" id="select_quyen">
                                    <option value="" selected>Chọn quyền</option>
                                    <option value="0">Nhân viên</option>
                                    <option value="1" >Admin</option>
                                    <option value="2" >SuperAdmin</option>
                                </select>
                            </div>
                            <div id="phongbanSelect" class="form-group" style="display: none;">
                                <label>Phòng ban</label>
                                <select class="form-control" name="phongban">
                                    <option value="">Chọn phòng ban</option>
                                    @foreach($dsphongban as $phongban)
                                        <option value="{{ $phongban->id }}">{{ $phongban->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="chucvuSelect" class="form-group" style="display: none;">
                                <label>Chức vụ</label>
                                <select class="form-control" name="chucvu">
                                    <option value="">Chọn chức vụ</option>
                                    @foreach($dschucvu as $chucvu)
                                        <option value="{{ $chucvu->id }}">{{ $chucvu->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Mật khẩu</label>
                                <input class="form-control" name="password" type="password" required placeholder="Nhập mật khẩu" />
                            </div>
                            <div class="form-group">
                                <label>Nhập lại mật khẩu</label>
                                <input class="form-control" name="passwordAgain" type="password" required placeholder="Nhập lại mật khẩu" />
                            </div>

                            <button type="submit" class="btn btn-default">Thêm</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                            <a href="/admin/user/danhsach" class="btn btn-danger">Hủy</a>
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
                // Check if the change event is triggered
                $('#select_quyen').change(function() {
                    var selectedValue = $('#select_quyen option:selected').val();

                    if (selectedValue != 2) {
                        $('#phongbanSelect').show();
                        $('#chucvuSelect').show();
                    } else {
                        $('#phongbanSelect').show();
                        $('#chucvuSelect').hide();
                    }
                });
            });
        </script>
@endsection
