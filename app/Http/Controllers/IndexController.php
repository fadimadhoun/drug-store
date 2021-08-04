<?php

namespace App\Http\Controllers;

use App\Models\Dispense;
use App\Models\Drug;
use DateTime;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        $drugs = Drug::all();
        $date1 = new DateTime(now()->format("Y-m-d"));
        $drug_ids = [];
        $index = 0;
        foreach($drugs as $drug){
            $date2 = new DateTime($drug->expire_date);
            if($date1->diff($date2)->days<=30){
                $drug_ids[$index]= $drug->id;
                $index++;
            }
            
        }
        $count_expire = count($drug_ids);
        $drug_ids = Dispense::all()->pluck('drug_id')->toArray();
        $drug_ids = array_unique($drug_ids);
        $count_more = count($drug_ids);
        $count_stock = Drug::where('qty','<',50)->count();
        return view('dashboard.index',compact('count_expire','count_more','count_stock'));
    }
    public function expire_date(){
                    
        $drugs = Drug::all();
        $date1 = new DateTime(now()->format("Y-m-d"));
        $drug_ids = [];
        $index = 0;
        foreach($drugs as $drug){
            $date2 = new DateTime($drug->expire_date);
            if($date1->diff($date2)->days<=30){
                $drug_ids[$index]= $drug->id;
                $index++;
            }
            
        }
        $drugs = Drug::whereIn('id',$drug_ids)->get();
        return view('dashboard.expire_date',compact('drugs'));
}
public function more(){//أكثر صرفا
                    
    $drug_ids = Dispense::all()->pluck('drug_id')->toArray();

    $drugs = Drug::whereIn('id',$drug_ids)->get();
    return view('dashboard.more',compact('drugs'));
}

public function stock(){
                    
    $drugs = Drug::where('qty','<',50)->get();
    return view('dashboard.drug_stock',compact('drugs'));
}
}
