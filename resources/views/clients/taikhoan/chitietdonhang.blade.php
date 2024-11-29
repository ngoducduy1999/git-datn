@extends('layouts.client') 

@section('content')
<div class="container-xl mb-4">
    <!-- Tiêu đề trang -->
    <div class="pt-4 mb-4">
        <h4 class="fw-bold ">Chi tiết đơn hàng</h4>
    </div>

    <!-- Thông tin người đặt hàng -->
    <div class="card border-0 shadow-sm rounded-3 mb-4">
        <div class="card-header bg-light">
            <h6 class="fw-semibold ">Thông tin người đặt hàng</h6>
        </div>
        <div class="card-body">
            <div class="row gy-3">
                <div class="col-lg-6">
                    <p><strong class="text-dark">Mã đơn hàng:</strong> <span>{{ $hoaDon->ma_hoa_don }}</span></p>
                    <p><strong class="text-dark">Tên người nhận:</strong> <span>{{ $hoaDon->ten_nguoi_nhan }}</span></p>
                    <p><strong class="text-dark">Email:</strong> <span>{{ $hoaDon->email }}</span></p>
                    <p><strong class="text-dark">Điện thoại:</strong> <span>{{ $hoaDon->so_dien_thoai }}</span></p>
                    <p><strong class="text-dark">Địa chỉ:</strong> <span>{{ $hoaDon->dia_chi_nhan_hang }}</span></p>
                </div>
                <div class="col-lg-6">
                    <p><strong class="text-dark">Ghi chú:</strong> <span>{{ $hoaDon->ghi_chu }}</span></p>
                    <p><strong class="text-dark">Trạng thái đơn hàng:</strong> 
                        <span class="badge bg-info text-dark">{{ $trangThaiHoaDon[$hoaDon->trang_thai] }}</span>
                    </p>
                    <p><strong class="text-dark">Phương thức thanh toán:</strong> <span>{{ $phuongThucThanhToan[$hoaDon->phuong_thuc_thanh_toan] }}</span></p>
                    <p><strong class="text-dark">Thanh toán:</strong> 
                        <span class="badge {{ $hoaDon->trang_thai_thanh_toan == 'Đã thanh toán' ? 'bg-success' : 'bg-warning text-dark' }}">
                            {{ $trangThaiThanhToan[$hoaDon->trang_thai_thanh_toan] }}
                        </span>
                    </p>
                    <p class="fw-bold text-orange fs-5">Tổng tiền: {{ number_format($hoaDon->tong_tien, 0, '', '.') }} đ</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Sản phẩm trong đơn hàng -->
    <div class="card border-0 shadow-sm rounded-3 bg-white">
        <div class="card-header fw-semibold text-orange">
            <h5 class="text-dark fw-bold mb-0">Sản phẩm trong đơn hàng</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-borderless align-middle mb-0">
                <thead class="bg-light">
                    <tr class="text-dark">
                        <th>Hình ảnh</th>
                        <th>Mã sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($chiTietHoaDons as $chiTiet)
                    <tr class="border-bottom">
                        <td class="position-relative">
                            <div class="product-img-wrapper overflow-hidden rounded" style="width: 80px; height: 80px;">
                                <img src="{{ asset($chiTiet->bienTheSanPham->sanPham->anh_san_pham) }}" alt="Sản phẩm" class="img-fluid rounded-3 product-img">
                            </div>
                        </td>
                        <td>{{ $chiTiet->bienTheSanPham->sanPham->ma_san_pham }}</td>
                        <td>
                            {{ $chiTiet->bienTheSanPham->sanPham->ten_san_pham }}
                            <br>
                            <small class="text-dark">
                                @if(isset($chiTiet->bienTheSanPham->dungLuong))
                                    Dung lượng: {{ $chiTiet->bienTheSanPham->dungLuong->ten_dung_luong }}
                                @else
                                    Dung lượng: Không có
                                @endif
                                <br>
                                @if(isset($chiTiet->bienTheSanPham->mauSac))
                                    Màu sắc: {{ $chiTiet->bienTheSanPham->mauSac->ten_mau_sac }}
                                @else
                                    Màu sắc: Không có
                                @endif
                            </small>
                        </td>
                        <td>{{ number_format($chiTiet->don_gia, 0, '', '.') }} đ</td>
                        <td>{{ $chiTiet->so_luong }}</td>
                        <td>{{ number_format($chiTiet->thanh_tien, 0, '', '.') }} đ</td>
                        <td>
                            @if ($hoaDon->trang_thai == 7)
                            <a href="#" class="btn btn-sm btn-warning rounded-pill" data-bs-toggle="modal" data-bs-target="#reviewModal" data-san-pham-id="{{ $chiTiet->bienTheSanPham->sanPham->id }}">Đánh giá</a>
                            @else
                            <span class="text-muted">Không thể đánh giá</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .text-orange {
        color: #f56a00;
    }
    .product-img-wrapper:hover .product-img {
        transform: scale(1.1);
        transition: transform 0.3s ease-in-out;
    }
    .product-img {
        transition: transform 0.3s ease-in-out;
        object-fit: cover;
    }
</style>

<!-- Modal Đánh Giá -->
@include('clients.taikhoan.review_modal')

@endsection
