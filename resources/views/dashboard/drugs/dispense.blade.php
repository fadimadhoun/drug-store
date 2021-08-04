@extends('layouts.master')
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
              <li class="breadcrumb-item"><a href="{{route('admin.drugs.index')}}">الأدوية</a></li>
              <li class="breadcrumb-item active">صرف</li>
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
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
            
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>الاسم</th>
                  <th>تاريخ انتهاء الصلاحية</th>
                  <th> المخزون</th>
                  <th> كمية الصرف</th>
                  <th>العمليات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($drugs as $index=>$drug)
                <tr id="tr_{{$drug->id}}">
                <td>{{$index+1}}</td>
                  <td>{{$drug->name}}</td>
                  <td>{{$drug->expire_date}}</td>
                  <td>{{$drug->qty}}</td>
                  <td><input type="number" id="qty_{{$drug->id}}" value="1" name="dispense_qty" min="1" max="{{$drug->qty}}" /></td>
                  <td>
                    @if(Auth::user()->hasPermission('dispense_drugs'))
                     <a class = "btn btn-primary submit-dispense" data-id="{{$drug->id}}" href="javascript:void(0)"><i class="fa fa-plus ml-3"></i></a>
                     @endif
                </td>
                </tr>
                @endforeach
                
                </tbody>
                <tfoot>
                <tr>
                  <th>#</th>
                  <th>الاسم</th>
                  <th>تاريخ انتهاء الصلاحية</th>
                  <th> المخزون</th>
                  <th id="qty"> كمية الصرف</th>
                  <th >العمليات</th>
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
    $(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#example1 tfoot th').each( function () {
     
        var title = $(this).text();
        if(title != 'العمليات')
        $(this).html( '<input style="width:100%" type="text" placeholder="'+title+'" />' );
        else
        $(this).html( '' );

        $('#qty').html( '' );

    } );
 
    // DataTable
    var table = $('#example1').DataTable({
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
  $('body').on('click', '.submit-dispense', function (ee) {
    ee.preventDefault();
    var id = $(this).data('id');
    var qty = $('#qty_'+id).val();
    window.location.href = '/admin/drugs/dispense/'+id+'?qty='+qty
  })
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