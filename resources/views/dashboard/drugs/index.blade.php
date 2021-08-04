@extends('layouts.master')
@section('style')
<style>
  tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
</style>
@endsection
@section('content')
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">ادارة مستودع أدوية</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.index')}}">الرئيسية</a></li>
              <li class="breadcrumb-item active">الادوية</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
     
        <div class="card">
            <div class="card-header">
              @if(Auth::user()->hasPermission('create_drugs'))
              <h3 class="card-title">  <a  href="{{route('admin.drugs.create')}}" class="btn btn-block btn-primary">اضافة دواء جديد</a></h3>
              @endif
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              
              <table id="example" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>الاسم</th>
                  <th>الشركة المصنعة</th>
                  <th> الكمية</th>
                  <th>تاريخ انتهاء الصلاحية</th>
              
                  <th>التأثيرات الجانبية</th>
                  <th>العمليات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($drugs as $index=>$drug)
                <tr id="tr_{{$drug->id}}">
                <td>{{$index+1}}</td>
                  <td>{{$drug->name}}</td>
                  <td>{{$drug->manufacture_company}}</td>
                  <td>{{$drug->qty}}</td>
                  <td>{{$drug->expire_date}}</td>
                  <td>{{\Illuminate\Support\Str::limit(strip_tags($drug->side_effect), 20, '...')}}</td>
                  <td>
                    @if(Auth::user()->hasPermission('edit_drugs'))
                     <a href="{{route('admin.drugs.edit',$drug->id)}}"><i class="fa fa-edit ml-3"></i></a>
                     @endif
                     @if(Auth::user()->hasPermission('delete_drugs'))
                     <a style="color:red" href="javascript:void(0)" class="deleteDrug" data-id="{{$drug->id}}"><i class="fa fa-trash ml-3"></i></a>
                     @endif
                </td>
                </tr>
                @endforeach
                
                </tbody>
                <tfoot>
            <tr>
            <th>#</th>
                  <th>الاسم</th>
                  <th>الشركة المصنعة</th>
                  <th> الكمية</th>
                  <th>تاريخ انتهاء الصلاحية</th>
              
                  <th>التأثيرات الجانبية</th>
                  <th>العمليات</th>
            </tr>
        </tfoot>
               
              </table>
        
            </div>
            <!-- /.card-body -->
          </div>

        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    {{-- Confirmation Modal --}}
    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">تأكيد عملية الحذف</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="delete_modal_form">
                    @csrf
                    {{method_field('delete')}}

                    <div class="modal-body">
                        <input type="hidden" id="delete_language">
                        <h5>هل أنت متأكد من حذف هذا الدواء !!</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel">الغاء</button>
                        <button type="submit" class="btn btn-danger" id="delete">حذف</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Confirmation Modal --}}
@endsection
@section('script')
<script>
  $(function () {

    var activityTable =$("#example1").DataTable();
    // $('#example2').DataTable({
    //   "paging": true,
    //   "lengthChange": false,
    //   "searching": false,
    //   "ordering": true,
    //   "info": true,
    //   "autoWidth": false,
    // });
    $(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#example tfoot th').each( function () {
        var title = $(this).text();
        if(title != 'العمليات')
        $(this).html( '<input type="text" placeholder="'+title+'" />' );
        else
        $(this).html( '' );
    } );
 
    // DataTable
    var table = $('#example').DataTable({
      "language": {
                 "url": "{{asset('datatables-ar.json')}}"
        },
        initComplete: function () {
            // Apply the search
            this.api().columns().every( function () {
                var that = this;
 
                $( 'input', this.footer() ).on( 'keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        }
    });
 
} );

  });
  

              $('body').on('click', '.deleteDrug', function (ee) {
                            ee.preventDefault();
                            var id = $(this).data('id');
                            $('#delete-modal').modal('show');
                            $('#delete').click(function (e) {
                                e.preventDefault();
                                $.ajax({

                                    url: '{{route('admin.drugs.destroy')}}',
                                    type: 'delete',
                                    data: {
                                    "_token": "{{ csrf_token() }}",
                                    "id": id
                                    },
                                    success: function (data) {
                                        console.log('success:', data);
                                        if (data.status === true) {
                                            $('#delete-modal').modal('hide');
                                            toastr.warning(data.msg);
                                          $('#tr_'+id).remove();
                                        }

                                    }

                                });
                            });

                            $('#cancel').click(function () {
                                $('#delete-modal').modal('hide');
                            });
            });
</script>
@endsection