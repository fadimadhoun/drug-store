<?php

namespace App\Http\Controllers;

use App\Models\Dispense;
use App\Models\Drug;
use App\Models\Permission;
use App\Models\User;
use App\Models\UserPermission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class DurgController extends Controller
{
    public function index(){
        if(Auth::user()->hasPermission('read_drugs')){
            $drugs = Drug::all();

            return view('dashboard.drugs.index',compact('drugs'));
        }
        return back();
        
    }
    public function create(){
        if(Auth::user()->hasPermission('create_drugs')){
            $permissions  = Permission::all();
            return view('dashboard.drugs.create',compact('permissions'));
        }
        return back();
    }
    public function store(Request $request){
        if(Auth::user()->hasPermission('create_drugs')){
            $rules = [
                'name' => 'required',
                'expire_date' => 'required',
                'qty' => 'required',
                'manufacture_company' => 'required',
                'side_effect' => 'required',
                
            ];
            $request->validate($rules);
            $drug = Drug::create([
                'name' => $request->name,
                'expire_date' => $request->expire_date,
                'qty' => $request->qty,
                'manufacture_company' => $request->manufacture_company,
                'side_effect' => $request->side_effect,
            ]);
            
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
    public function edit(Drug $drug){
        if(Auth::user()->hasPermission('edit_drugs')){
            return view('dashboard.drugs.create',compact('drug'));
        }
        $notification = array(
            'message' => 'ليس لديك صلاحية',
            'alert-type' => 'info'
        );
        return back()->with($notification);
    }
    public function update(Request $request,Drug $drug){
        if(Auth::user()->hasPermission('edit_drugs')){
            $rules = [
                'name' => 'required',
                'expire_date' => 'required',
                'qty' => 'required',
                'manufacture_company' => 'required',
                'side_effect' => 'required',
            ];
          
            $request->validate($rules);
            $drug ->update([
                'name' => $request->name,
                'expire_date' => $request->expire_date,
                'qty' => $request->qty,
                'manufacture_company' => $request->manufacture_company,
                'side_effect' => $request->side_effect,
            ]);
           
           
            $notification = array(
                'message' => 'تم التعديل  بنجاح',
                'alert-type' => 'success'
            );
           return redirect()->route('admin.drugs.index')->with($notification);
        }
        $notification = array(
            'message' => 'ليس لديك صلاحية',
            'alert-type' => 'info'
        );
        return back()->with($notification);
    }
    public function destroy(Request $request){
        if(Auth::user()->hasPermission('edit_drugs')){
            $drug  = Drug::find($request->id);
        
        $drug->delete();
        return response()->json([
            'status' => true,
            'msg' => 'تم حذف الدواء بنجاح'
        ]);
        }else{
            return response()->json([
                'status' => true,
                'msg' => 'ليس لديك صلاحية'
            ]);
        }
        
    }

    public function dispenseFront(){//صرف أدوية
        if(Auth::user()->hasPermission('dispense_drugs')){
            $drugs = Drug::all();
            
            return view('dashboard.drugs.dispense',compact('drugs'));
        }
        $notification = array(
            'message' => 'ليس لديك صلاحية',
            'alert-type' => 'info'
        );
        return back()->with($notification);
    }
    public function dispenseStore(Request $request,Drug $drug){
        if(Auth::user()->hasPermission('dispense_drugs')){
           $rules = [
            'qty' => 'required',
        ];
        $request->validate($rules);
        if($request->qty <= $drug->qty){
            $drug->qty = $drug->qty - $request->qty;
            $drug->save();
            Dispense::create([
                'user_id' =>Auth::user()->id,
                'drug_id' =>$drug->id,
                'qty' =>$request->qty,
            ]);
        }else{
            $notification = array(
                'message' => 'لا توجد كمية كافية',
                'alert-type' => 'warning'
            );
            return back()->with($notification);  
        }
       
        $notification = array(
            'message' => 'تم الصرف بنجاح',
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
    public function list_dispense(){
        if(Auth::user()->hasPermission('dispense_drugs')){
            $dispenses = Dispense::all();
            return view('dashboard.drugs.list',compact('dispenses'));
        }
        $notification = array(
            'message' => 'ليس لديك صلاحية',
            'alert-type' => 'info'
        );
        return back()->with($notification);
    }
}
