@if(session()->get('msg'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session()->get('msg') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                {{ Session::forget('msg') }}
            </button>
        </div>
@endif
<div class="col-lg-12 col-md-12">
    <div class="chua">
        <form class="form-header" action="{{ url('/search') }}" method="GET">
            <input class="au-input au-input--xl" type="text" id="myInput" onkeyup="myFunction()" name="query" placeholder="Tìm tên nhân viên ..." />
            <button class="au-btn--submit" type="submit">
                <i class="zmdi zmdi-search"></i>
            </button>
        </form>

        <button class="au-btn au-btn-icon au-btn--blue ">
        <a href="{{ route('nhanvien.create')}}" style="color: white;"><i class="zmdi zmdi-plus"></i>Thêm Nhân Viên</a></button>
    </div>
        <div class="table-responsive table--no-card m-b-30">
            <table id="myTable" class="table table-borderless table-striped table-earning">
                <thead class="text-warning">
                    <th>ID</th>
                    <th>Tên nhân viên</th>
                    <th>Email</th>
                    <th>Điện thoại</th>
                    <th>Password</th>
                    <th>Giới Tính</th>
                    <th>Hành động</th>
                </thead>

                <tbody>
                @foreach($nv as $row)
                    <tr>
                        <td>{{ $row->Id_NV }}</td>
                        <td>{{ $row->Ten_NV }}</td>
                        <td>{{ $row->email }}</td>
                        <td>{{ $row->DienThoai }}</td>
                        <td>{{ $row->password }}</td>
                        @if( $row->Gioi_Tinh == 1)
                        <td>Nam</td>
                        @else
                        <td>Nữ</td>
                        @endif
                        <td class="td-actions">
                            <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                                <a href="{{route('nhanvien.edit',$row->Id_NV)}}"><i class="material-icons">Edit</i></a>
                            </button>
                            
                            <form action="{{route('nhanvien.destroy',$row->Id_NV)}}" method="post" class="btn btn-link btn-sm">
                                {{  csrf_field() }}
                                {!! method_field('delete') !!}
                                <button onclick="return confirm('Bạn có chắc muốn xóa ?');"  class="btn btn-danger btn-link btn-sm">
                                    <i class="material-icons">Close</i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
</div>
<script>
    function myFunction() {
      // Declare variables
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
    
      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }
</script>
<style>
    .mt-150{
        margin-top: 100px;
    }
    button.au-btn.au-btn-icon.au-btn--blue {
        margin-bottom: 20px;
    }
    .chua{
        width: 100%;
        float: left;
    }

    .chua .form-header {
        float: left;
        margin-right: 30px;
    }
</style>