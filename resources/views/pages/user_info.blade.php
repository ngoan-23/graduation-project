@extends('layout.index')
@section('title')
Trang chủ
@endsection

@section('content')
<div class="col-md-9">
        <h2>Thông tin người dùng</h2>
        @if(count($errors) > 0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $err )
                    {{ $err }}<br>
                @endforeach
            </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form action="/thongtinnguoidung/{{ $user->id }}" method="POST" style="width: 60%; margin-bottom: 3rem">
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
                <select class="form-control" name="phongban" disabled>
                    <option value="">Chọn phòng ban</option>
                    @foreach($dsphongban as $phongban)
                        <option value="{{ $phongban->id }}" {{ $user->phongban[0]->id == $phongban->id ? 'selected' : '' }}>{{ $phongban->name }}</option>
                    @endforeach
                </select>
            </div>
            <div id="chucvuSelect" class="form-group">
                <label>Chức vụ</label>
                <select class="form-control" name="chucvu" disabled>
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
                <label>Mật khẩu</label>
                <input class="form-control password" name="password" value="{{ $user->password }}" type="password" placeholder="Nhập mật khẩu" />
            </div>
            <div class="form-group">
                <label>Nhập lại mật khẩu</label>
                <input class="form-control password" name="password_confirmation" type="password" placeholder="Nhập lại mật khẩu" />
            </div>

            <button type="submit" class="btn btn-success">Sửa</button>
            <a href="{{ url()->previous() }}" class="btn btn-danger">Hủy</a>
        <form>
</div>
@endsection