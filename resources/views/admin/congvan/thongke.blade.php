@extends('admin.layout.index')
@section('title')
Thống kê Công Văn
@endsection
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div  style="color: crimson">
            <h1 class="page-header">Thống kê Công Văn
            </h1><br>
        </div>
        <!-- Thống kê Công Văn Nội Bộ -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3>Công Văn Nội Bộ</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Năm</th>
                                <th>Tháng</th>
                                <th>Số lượng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                // Tạo data cho biểu đồ 
                                $array = [];
                                $congVanNoiBo = array_fill(1, 12, array("totalCongVan" => 0));
                            @endphp
                            <!-- Dữ liệu thống kê cho công văn nội bộ -->
                            @foreach ($thongKeCongVan as $index => $results)
                                @foreach ($results as $idLoaiHinh => $result)
                                    @if ($idLoaiHinh == 2)
                                        @php
                                            // Kiểm tra xem key $index đã tồn tại trong mảng chưa
                                            if (!isset($thongKeCongVan[$index])) {
                                                $thongKeCongVan[$index] = [];
                                            }
                                            // Gán giá trị totalCongVan vào mảng
                                            for ($i = 1; $i <= 12; $i++) {
                                                if($i == $index && !empty($index)) {
                                                    $array[$i]['totalCongVan'] = $result['totalCongVan'];
                                                } else {
                                                    $array[$i]['totalCongVan'] = 0;
                                                }
                                            }
                                            // Gộp hai mảng
                                            foreach ($array as $key => $value) {
                                                $congVanNoiBo[$key]["totalCongVan"] += $value["totalCongVan"];
                                            }
                                        @endphp
                                        
                                        <tr>
                                            <td>{{ $year }}</td>
                                            <td>Tháng {{ $index }}</td>
                                            <td>{{ $result['totalCongVan'] }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                            <!-- ... Thêm dữ liệu cho các năm khác ... -->
                        </tbody>
                    </table>
                    <canvas id="congVanNoiBoChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
        <!-- Thống kê Công Văn Đến -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3>Công Văn Đến</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Năm</th>
                                <th>Tháng</th>
                                <th>Số lượng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                // Tạo data cho biểu đồ 
                                $array = [];
                                $congVanDen = array_fill(1, 12, array("totalCongVan" => 0));
                            @endphp
                            <!-- Dữ liệu thống kê cho công văn đến -->
                            @foreach ($thongKeCongVan as $index => $results)
                                @foreach ($results as $idLoaiHinh => $result)
                                    @if ($idLoaiHinh == 3)
                                        @php
                                        // Kiểm tra xem key $index đã tồn tại trong mảng chưa
                                        if (!isset($thongKeCongVan[$index])) {
                                            $thongKeCongVan[$index] = [];
                                        }
                                        // Gán giá trị totalCongVan vào mảng
                                        for ($i = 1; $i <= 12; $i++) {
                                            if($i == $index && !empty($index)) {
                                                $array[$i]['totalCongVan'] = $result['totalCongVan'];
                                            } else {
                                                $array[$i]['totalCongVan'] = 0;
                                            }
                                        }
                                        // Gộp hai mảng
                                        foreach ($array as $key => $value) {
                                            $congVanDen[$key]["totalCongVan"] += $value["totalCongVan"];
                                        }
                                    @endphp
                                        <tr>
                                            <td>{{ $year }}</td>
                                            <td>Tháng {{ $index }}</td>
                                            <td>{{ $result['totalCongVan'] }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                            <!-- ... Thêm dữ liệu cho các năm khác ... -->
                        </tbody>
                    </table>
                    <canvas id="congVanDenChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>

        <!-- Thống kê Công Văn Đi -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3>Công Văn Đi</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Năm</th>
                                <th>Tháng</th>
                                <th>Số lượng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Dữ liệu thống kê cho công văn đi -->
                            @php
                                // Tạo data cho biểu đồ 
                                $array = [];
                                $congVanDi = array_fill(1, 12, array("totalCongVan" => 0));
                            @endphp
                            @foreach ($thongKeCongVan as $index => $results)
                                @foreach ($results as $idLoaiHinh => $result)
                                    @if ($idLoaiHinh == 4)
                                        @php
                                            // Kiểm tra xem key $index đã tồn tại trong mảng chưa
                                            if (!isset($thongKeCongVan[$index])) {
                                                $thongKeCongVan[$index] = [];
                                            }
                                            // Gán giá trị totalCongVan vào mảng
                                            for ($i = 1; $i <= 12; $i++) {
                                                if($i == $index && !empty($index)) {
                                                    $array[$i]['totalCongVan'] = $result['totalCongVan'];
                                                } else {
                                                    $array[$i]['totalCongVan'] = 0;
                                                }
                                            }
                                            // Gộp hai mảng
                                            foreach ($array as $key => $value) {
                                                $congVanDi[$key]["totalCongVan"] += $value["totalCongVan"];
                                            }
                                        @endphp
                                        <tr>
                                            <td>{{ $year }}</td>
                                            <td>Tháng {{ $index }}</td>
                                            <td>{{ $result['totalCongVan'] }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                    <canvas id="congVanDiChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var dataNoiBo  = @json(array_map(function($item) {
            return isset($item['totalCongVan']) ? $item['totalCongVan'] : 0;
        }, $congVanNoiBo));

        var dataDen  = @json(array_map(function($item) {
            return isset($item['totalCongVan']) ? $item['totalCongVan'] : 0;
        }, $congVanDen));
        var dataDi  = @json(array_map(function($item) {
            return isset($item['totalCongVan']) ? $item['totalCongVan'] : 0;
        }, $congVanDi));

         // Tạo biểu đồ Công Văn Nội Bộ
         var ctxDen = document.getElementById('congVanNoiBoChart').getContext('2d');
        var congVanDenChart = new Chart(ctxDen, {
            type: 'bar',
            data: {
                datasets: [{
                    label: 'Công Văn Nội Bộ',
                    data: dataNoiBo,
                    backgroundColor: 'rgb(49 74 199 / 85%)',
                    borderColor: 'rgb(49 74 199 / 85%)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Tạo biểu đồ Công Văn Đến
        var ctxDen = document.getElementById('congVanDenChart').getContext('2d');
        var congVanDenChart = new Chart(ctxDen, {
            type: 'bar',
            data: {
                datasets: [{
                    label: 'Công Văn Đến',
                    data: dataDen,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Tạo biểu đồ Công Văn Đi (tương tự như trên, thay đổi id và dữ liệu)
        var ctxDi = document.getElementById('congVanDiChart').getContext('2d');
        var congVanDiChart = new Chart(ctxDi, {
            type: 'bar',
            data: {
                datasets: [{
                    label: 'Công Văn Đi',
                    data: dataDi,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
@endsection
