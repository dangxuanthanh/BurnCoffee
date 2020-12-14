@extends('quantri.layoutquantri')
@section('pagetitle', 'CHỈNH LOẠI SẢN PHẨM') 
@section('main')
@if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
@endif
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                Nhân Viên
                <small>
                    <code>*</code>
                </small>
            </div>
            <div class="card-body card-block">
                <form action="{{ route('nhanvien.update', $row->Id_NV) }}" method="post" class="form-horizontal">
                {{ csrf_field() }}
                {!! method_field('patch') !!}
                    <div class="row form-group">
                        <div class="col-12">
                            <label class="form-check-label" for="exampleCheck1">Tên Nhân Viên</label>
                            <input type="text" name="Ten_NV" value="{{ $row->Ten_NV }}"  class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-6">
                            <label class="form-check-label" for="exampleCheck1">Email</label>
                            <input type="text" name="email" value="{{ $row->email }}" class="form-control">
                        </div>

                        <div class="col-6">
                            <label class="form-check-label" for="exampleCheck1">Số Điện Thoại</label>
                            <input type="text" name="DienThoai" value="{{ $row->DienThoai }}" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-6">
                            <label class="form-check-label" for="exampleCheck1">Mật Khẩu</label>
                            <input type="text" name="password" value="{{ $row->password }}" class="form-control">
                        </div>

                        <div class="col-6">
                            <label for="Gioi_Tinh" class="form-check-label ">{{ __('Gioi tinh') }}</label>
                                    <select name="Gioi_Tinh" id="Gioi_Tinh" value="{{ $row->Gioi_Tinh }}" class="form-control q">
                                        @if($row->Gioi_Tinh == 1)
                                            <option class="q"  value="{{ $row->Gioi_Tinh }}">Nam</option>                                
                                        @else
                                            <option class="q"  value="{{ $row->Gioi_Tinh }}">Nữ</option>
                                        @endif
                                            <option class="q"  value="1">Nam</option>
                                            <option class="q"  value="2">Nữ</option> 
                                    </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mt-20">Sửa</button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
    <style>
        .ml-20{
            margin-left: 20px;
        }
        .mt-20{
            margin-top: 20px
        }
        .fl{
            float: left;
        }
    </style>

@endsection