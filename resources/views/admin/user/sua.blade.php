@extends('admin.layout.index')
@section('title')
Sửa Người dùng
@endsection


@section('content')

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Người dùng
                            <small>sửa</small>
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
                        <form action="admin/user/sua/{{ $user->id }}" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label>Tên người dùng</label>
                                <input class="form-control" name="name" value="{{ $user->name }}" placeholder="Nhập tên người dùng" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" name="email" value="{{ $user->email }}" disabled type="email" placeholder="Nhập email người dùng" />
                            </div>
                            <div class="form-group">
                                <label>Quyền</label>
                                <select class="form-control" name="level" {{ $user->level != 2 ? 'disabled' : '' }}>
                                    <option @if($user->level == 1) selected @endif {{ $user->level == 2 ? 'disabled' : '' }} value="1">Admin</option>
                                    <option @if($user->level == 2) selected @endif {{ $user->level == 2 ? 'disabled' : '' }} value="2">SuperAdmin</option>
                                    <option @if($user->level == 0) selected @endif {{ $user->level == 2 ? 'disabled' : '' }} value="1">Nhân viên</option>
                                </select>
                            </div>
                            @if ($user->level != 2)
                            <div id="phongbanSelect" class="form-group">
                                <label>Phòng ban</label>
                                <select class="form-control" name="phongban">
                                    <option value="">Chọn phòng ban</option>
                                    @foreach($dsphongban as $phongban)
                                        <option value="{{ $phongban->id }}" {{ $user->phongban[0]->id == $phongban->id ? 'selected' : '' }}>{{ $phongban->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="chucvuSelect" class="form-group">
                                <label>Chức vụ</label>
                                <select class="form-control" name="chucvu">
                                    <option value="">Chọn chức vụ</option>
                                    @foreach($dschucvu as $chucvu)
                                        <option value="{{ $chucvu->id }}" 
                                            {{ $user->chucvu[0]->id == $chucvu->id ? 'selected' : '' }}
                                            >{{ $chucvu->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif
                            <div class="form-group">
                                <input type="checkbox" id="changePassword" name="changePassword" >
                                <label>Mật khẩu</label>
                                <input class="form-control password" disabled name="password" value="{{ $user->password }}" type="password" placeholder="Nhập mật khẩu" />
                            </div>
                            <div class="form-group">
                                <label>Nhập lại mật khẩu</label>
                                <input class="form-control password" disabled name="password_confirmation" type="password" placeholder="Nhập lại mật khẩu" />
                            </div>

                            <button type="submit" class="btn btn-default">Sửa</button>
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

@endsection

@section('script')

    <script type="text/javascript">
        $(document).ready(function(){
            $("#changePassword").change(function(){
                if($(this).is(":checked")){
                    $(".password").removeAttr('disabled');
                }else{
                    $(".password").attr('disabled','');
                }
            });
        });
    </script>

@endsection