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
              <li class="breadcrumb-item active">قائمة صرف الادوية</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid"> <div class="card">
            <div class="card-header">
            
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>اسم الدواء</th>
                  <th>الصارف</th>
                  <th> الكمية</th>
                  <th> تاريخ الصرف</th>
                </tr>
                </thead>
                <tbody>
                @foreach($dispenses as $index=>$dispense)
                <tr >
                <td>{{$index+1}}</td>
                  <td>{{$dispense->drug($dispense->drug_id)->name}}</td>
                  <td>{{$dispense->user($dispense->user_id)->name}}</td>
                  <td>{{$dispense->qty}}</td>
                  <td>{{$dispense->created_at}}</td>
                 
                </tr>
                @endforeach
              
                </tbody>
                <tfoot>
                <tr>
                  <th>#</th>
                  <th>اسم الدواء</th>
                  <th>الصارف</th>
                  <th> الكمية</th>
                  <th> تاريخ الصرف</th>
                </tr>
                </tfoot>
               
              </table>
            </div>
            <!-- /.card-body -->
          </div>

        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
  
@endsection
@section('script')
<script>

  $(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#example1 tfoot th').each( function () {
        var title = $(this).text();
        if(title != 'العمليات')
        $(this).html( '<input type="text" placeholder="'+title+'" />' );
        else
        $(this).html( '' );
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
  
                        

</script>
@endsection