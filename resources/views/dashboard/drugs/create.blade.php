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
              <li class="breadcrumb-item"><a href="{{route('admin.drugs.index')}}">الادوية</a></li>
              <li class="breadcrumb-item active">
                  {{isset($drug)?'تعديل':'اضافة'}}
              </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid"> 
      <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">{{isset($drug)?'تعديل':'اضافة دواء جديد'}}</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" action="{{isset($drug)?route('admin.drugs.update',$drug->id):route('admin.drugs.store')}}">
                @csrf
                <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputname1">الاسم </label>
                    <input type="text" class="form-control  @error('name') is-invalid @enderror" id="exampleInputname1" name="name" value="{{isset($drug)?$drug->name:old('name') }}" placeholder="الاسم ">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror 
                </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1"> الشركة المصنعة</label>
                    <input type="text" class="form-control  @error('manufacture_company') is-invalid @enderror" id="exampleInputEmail1" name="manufacture_company" value="{{isset($drug)?$drug->manufacture_company:old('manufacture_company') }}" placeholder=" الشركة المصنعة">
                    @error('manufacture_company')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror 
                </div>
                 <!-- Date range -->
                 <div class="form-group @error('expire_date') is-invalid @enderror">
                  <label> تاريخ انتهاء الصلاحية</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input value="{{isset($drug)?$drug->expire_date:old('expire_date') }}" type="date" name="expire_date" class="form-control float-right" >
                    @error('expire_date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror 
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
                <div class="form-group">
                    <label for="exampleInputEmail7"> الكمية</label>
                    <input type="number"  class="form-control  @error('qty') is-invalid @enderror" id="exampleInputEmail7" name="qty" value="{{isset($drug)?$drug->qty:old('qty') }}" placeholder="الكمية">
                    @error('qty')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror 
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail8 @error('side_effect') is-invalid @enderror"> الاثار الجانبية</label>
                    <textarea name="side_effect" class="textarea @error('side_effect') is-invalid @enderror" id="exampleInputEmail8"  placeholder="الأثار الجانبية">
                    {{isset($drug)?$drug->side_effect:old('side_effect') }}
                    </textarea>
                    @error('side_effect')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror 
                </div>
                


               
                
               
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">{{isset($drug)?'تعديل':'اضافة'}}</button>
                </div>
              </form>
            </div>
          </div>
      </div>
      
      </div><!-- /.container-fluid -->
    </section>

@endsection
@section('script')
<script>
      //Date range picker
</script>
@endsection