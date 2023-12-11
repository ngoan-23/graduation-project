@extends('admin.layout.index')
@section('title')
Danh sách Công văn
@endsection
@section('content')
<style>
    .btn{
        font-size: 20px;
        width: 150px;
        height: 50px;
        border: solid #FFC7C7;
        background:#FFC7C7;
        margin-bottom: 10px;
    }
</style>
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div  style="color: crimson">
                        <h1 class="page-header">Công văn - văn bản
                            <small>danh sách</small>
                        </h1>
                    </div>
                    <div style="display: flex; height: 6rem;">
                        @if ($chucvu == 3)
                            <div>
                                <a href="admin/congvan/them"><span class="btn">Thêm</span></a>
                            </div>
                        @endif
                        <div class="container-filter">
                            <form>
                                <select name="department"  class="form-select-pb">
                                    <option value="" selected>Chọn phòng ban</option>
                                    @foreach ($dsphongban as $phongban)
                                        <option value="{{ $phongban->id }}" {{ request()->department == $phongban->id ? 'selected' : '' }}>{{ $phongban->name }}</option>
                                    @endforeach
                                </select>
                                <select name="dispatch" class="form-select-lcv" > 
                                    <option value="" selected>Loại công văn</option>
                                    @foreach ($dsloaihinhcongvan as $loaiphongban)
                                        <option value="{{ $loaiphongban->id }}" {{ request()->dispatch == $loaiphongban->id ? 'selected' : '' }}>{{ $loaiphongban->name }}</option>
                                    @endforeach
                                </select>
                                <button class="btn-search" type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
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
                    <table class="table table-striped table-bordered table-hover" id="">
                        <thead>
                            <tr align="center">
                                <th width="1%">STT</th>
                                <th width="3%">Số hiệu</th>
                                <th width="3%">Ngày ký</th>
                                <th width="5%">Phòng ban</th>
                                <th width="10%">Trích yếu nội dung</th>
                                <th width="3%">Ngày chuyển</th>
                                <th width="10%">Cơ quan ban hành</th>
                                <th width="5%">Hình thức</th>
                                <th width="8%">Lĩnh vực</th>
                                <th width="8%">Loại văn bản</th>
                                <th width="3%">Người ký</th>
                                <th width="8%">Tùy chọn</th>
                                <th width="8%">Tải xuống</th>
                                <th width="6%">Phê Duyệt</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Kiểm tra dữ liệu của bảng nếu k có thì in ra Bảng hiện có dữ liệu --}}
                            @if(count($congvan) == 0)
                            <tr>Bảng hiện tại chưa có dữ liệu</tr>
                            @endif

                            <?php
                            //Cách xuất STT
                            $i = 1;
                            if (isset($_GET['page']) && $_GET['page'] != 1) {
                                $i = (($_GET['page'] - 1) * 10) + 1;
                            }
                            ?>
                            @foreach($congvan as $key => $value)
                                <tr class="odd gradeX" align="center">
                                    <td>{{ $i }}</td><?php $i++;?>
                                    <td>{{ $value->sohieu }}</td>
                                    <td>{{ Carbon\Carbon::parse($value->ngayky)->format('d/m/Y') }}</td>
                                    <td>{{ $value->tenPhongBan }}</td>
                                    <td>{{ $value->trichyeunoidung }}</td>
                                    <!-- kiểm tra ngaychuyen khác null -->
                                    @if($value->ngaychuyen != '')
                                        <td>{{ Carbon\Carbon::parse($value->ngaychuyen)->format('d/m/Y') }}</td>
                                    @else
                                        <td>-</td>
                                    @endif
                                    <td>{{ $value->coquanbanhanh->name }}</td>
                                    <td>{{ $value->hinhthucvanban->name }}</td>
                                    <td>{{ $value->linhvuc->name }}</td>
                                    <td>{{ $value->loaivanban->name }}</td>
                                    <td>{{ $value->tenNguoiKy }}</td>
                                    <td class="btn-action">
                                        <div style="display: flex; justify-content: center; align-items: center;">
                                            @if (auth()->user()->level == 2)
                                                <a href="admin/congvan/xoa/{{ $value->id }}"><i class="fa fa-trash-o  fa-fw"></i></a>
                                            @endif
                                            <a href="admin/congvan/sua/{{ $value->id }}"><i class="fa fa-pencil fa-fw"></i> </a>
                                            <a href="{{ asset('storage/'. $value->tentaptindinhkem) }}" target="_blank"><i class="fa fa-eye fa-fw"> </i></a>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="/download/{{ $value->id }}">
                                            <div  class="glyphicon glyphicon-download-alt"></div>
                                        </a>
                                    </td>
                                    <td style="padding: 8px 0"> 
                                        @if (auth()->user()->id == $value->nguoiky && $value->is_active != true)
                                        <div>
                                            <a style="color: #334db7; font-size: 12px" href="{{ route('phe-duyet-cong-van', ['id' => $value->id]) }}"><i class="fa fa-check fa-fw"></i> Phê duyệt</a><br>
                                            <a style="color: #b73333; font-size: 12px" href="{{ route('khong-phe-duyet-cong-van', ['id' => $value->id]) }}"><i class="fa fa-times fa-fw"></i>Từ chối phê duyệt </a>
                                        </div>
                                        @elseif ($value->is_active == 3)
                                            <span style="color: #b73333; font-size: 12px">Không được phê duyệt</span>
                                        @elseif ($value->is_active == true)
                                            <span style="color: #40b733; font-size: 12px">Đã phê duyệt</span>
                                        @else 
                                            <span style="color: #333eb7; font-size: 12px">Chờ phê duyệt</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$congvan->appends(request()->all())->links()}}  
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection