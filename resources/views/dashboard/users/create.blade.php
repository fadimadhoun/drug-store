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
              <li class="breadcrumb-item"><a href="{{route('admin.users.index')}}">المستخدمين</a></li>
              <li class="breadcrumb-item active">
                  {{isset($user)?'تعديل':'اضافة'}}
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
                <h3 class="card-title">{{isset($user)?'تعديل':'اضافة مستخدم جديد'}}</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" action="{{isset($user)?route('admin.users.update',$user->id):route('admin.users.store')}}">
                @csrf
                <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputname1">الاسم </label>
                    <input type="text" class="form-control  @error('name') is-invalid @enderror" id="exampleInputname1" name="name" value="{{isset($user)?$user->name:old('name') }}" placeholder="الاسم ">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror 
                </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">البريد الالكتروني</label>
                    <input type="email" class="form-control  @error('email') is-invalid @enderror" id="exampleInputEmail1" name="email" value="{{isset($user)?$user->email:old('email') }}" placeholder="البريد الالكتروني">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror 
                </div>
                
                  <div class="form-group">
                    <label for="exampleInputPassword1">كلمة المرور</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1" name="password" placeholder="كلمة المرور">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror  
                </div>
                  <div class="form-group">
                    <label for="exampleInputPassword2">كلمة المرور</label>
                    <input type="password" class="form-control @error('password_confirm') is-invalid @enderror" id="exampleInputPassword2" name="password_confirm" placeholder="كلمة المرور">
                    @error('password_confirm')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror  
                </div>


                <div class="form-group">
                    <label for="permissions">الصلاحيات</label>
                    
                    @error('permissions')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror 
                    <div class="row">
                          @foreach($permissions as $permission)
                            <div class="form-check col-lg-3">
                                <input type="checkbox" class="form-check-input @error('permissions') is-invalid @enderror" value="{{$permission->id}}" name="permissions[]" {{isset($user)?$user->hasPermission($permission->name)?'checked':'':''}} >
                                @if($permission->name == 'read_users')   
                                 <label class="form-check-label">عرض المستخدمين</label>
                                 @elseif($permission->name == 'create_users')   
                                 <label class="form-check-label">انشاء المستخدمين</label>
                                 @elseif($permission->name == 'edit_users')   
                                 <label class="form-check-label">تعديل المستخدمين</label>
                                 @elseif($permission->name == 'delete_users')   
                                 <label class="form-check-label">حذف المستخدمين</label>
                                 @elseif($permission->name == 'read_drugs')   
                                 <label class="form-check-label">عرض الأدوية</label>
                                 @elseif($permission->name == 'create_drugs')   
                                 <label class="form-check-label">انشاء الأدوية</label>
                                 @elseif($permission->name == 'edit_drugs')   
                                 <label class="form-check-label">تعديل الأدوية</label>
                                 @elseif($permission->name == 'delete_drugs')   
                                 <label class="form-check-label">حذف الأدوية</label>
                                 @elseif($permission->name == 'dispense_drugs')   
                                 <label class="form-check-label">صرف أدوية</label>
                                 @elseif($permission->name == 'read_dispense_drugs')   
                                 <label class="form-check-label">عرض عمليات الصرف </label>
                                 @endif
                           
                            </div>
                           @endforeach    
                      </div>
                    
                </div>
                
               
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">{{isset($user)?'تعديل':'اضافة'}}</button>
                </div>
              </form>
            </div>
          </div>
      </div>
      
      </div><!-- /.container-fluid -->
    </section>

@endsection