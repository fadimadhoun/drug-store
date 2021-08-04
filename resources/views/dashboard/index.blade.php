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
              <li class="breadcrumb-item active">الرئيسية</li>
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
     
        <div class="row">
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$count_expire}}</h3>

                <p>الأدوية التي  اقتربت نهاية صلاحيتها</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{route('admin.drugs.expire_date')}}" class="small-box-footer">المزيد <i class="fas fa-arrow-circle-left"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$count_more}}<sup style="font-size: 20px"></sup></h3>

                <p>أكثر الأدوية صرفا</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{route('admin.drugs.more')}}" class="small-box-footer">المزيد <i class="fas fa-arrow-circle-left"></i></a>
            </div>
          </div>
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$count_stock}}</h3>

                <p>الأدوية التي  اقترب نفاذ مخزونها</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{route('admin.drugs.stock')}}" class="small-box-footer">المزيد <i class="fas fa-arrow-circle-left"></i></a>
            </div>
          </div>
         
        </div>

        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>

@endsection