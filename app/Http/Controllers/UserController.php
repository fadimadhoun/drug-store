<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use App\Models\UserPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(){
        if(Auth::user()->hasPermission('read_users')){
            $users = User::where('email','!=','admin@gmail.com')->get();

            return view('dashboard.users.index',compact('users'));
        }
        return back();
        
    }
    public function create(){
        if(Auth::user()->hasPermission('create_users')){
            $permissions  = Permission::all();
            return view('dashboard.users.create',compact('permissions'));
        }
        return back();
    }
    public function store(Request $request){
        if(Auth::user()->hasPermission('create_users')){
            $rules = [
                'email' => 'required|email|unique:users,email',
                'name' => 'required',
                'password' => 'required|min:3',
                'password_confirm' => 'required|min:3',
                'permissions' => 'required',
                
            ];
            $request->validate($rules);
            $user = User::create([
                'email' => $request->email,
                'name' => $request->name,
                'password' => Hash::make($request->password),
            ]);
            foreach($request->permissions as $permission){
                $per = UserPermission::create([
                    'user_id' =>$user->id,
                    'permission_id' =>$permission,
                ]);
               
            }
            $notification = array(
                'message' => 'تمت الاضافة  بنجاح',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }
        $notification = array(
            'message' => 'ليس لديك صلاحية',
            'alert-type' => 'info'
        );
        return back()->with($notification);
    }
    public function edit(User $user){
        if(Auth::user()->hasPermission('edit_users')){
            $permissions  = Permission::all();
            return view('dashboard.users.create',compact('permissions','user'));
        }
        $notification = array(
            'message' => 'ليس لديك صلاحية',
            'alert-type' => 'info'
        );
        return back()->with($notification);
    }
    public function update(Request $request,User $user){
        if(Auth::user()->hasPermission('edit_users')){
            $rules = [
                'email' => [
                    'required',
                    Rule::unique('users')->ignore($user->id),
                ],
                'name' => 'required',
                'permissions' => 'required',
               
                
            ];
          
            $request->validate($rules);
            $user ->update([
                'email' => $request->email,
                'name' => $request->name,
                'password' =>!is_null($request->password)?Hash::make($request->password):$user->password,
            ]);
            $permissions = UserPermission::where('user_id',$user->id)->get();
            foreach($permissions as $permission){
                $permission->delete();
            }
            foreach($request->permissions as $permission){
                $per = UserPermission::create([
                    'user_id' =>$user->id,
                    'permission_id' =>$permission,
                ]);
               
            }
            $notification = array(
                'message' => 'تم التعديل  بنجاح',
                'alert-type' => 'success'
            );
           return redirect()->route('admin.users.index')->with($notification);
        }
        $notification = array(
            'message' => 'ليس لديك صلاحية',
            'alert-type' => 'info'
        );
        return back()->with($notification);
    }
    public function destroy(Request $request){
        $user  = User::find($request->id);
        $permissions  = UserPermission::where('user_id',$user->id)->get();
        foreach($permissions as $permission){
            $permission->delete();
        } 
        $user->delete();
        return response()->json([
            'status' => true,
            'msg' => 'تم حذف المستخدم بنجاح'
        ]);
    }
}
