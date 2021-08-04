<?php

namespace App\Providers;

use App\Models\Drug;
use App\Models\User;
use App\Notifications\DrugExipre;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        

            // $drugs = Drug::all();
            // $date1 = new DateTime(now()->format("Y-m-d"));
            // $drug_ids = [];
            // $index = 0;
            // foreach($drugs as $drug){
            //     $date2 = new DateTime($drug->expire_date);
            //     if($date1->diff($date2)->days<=30){
            //         $drug_ids[$index]= $drug->id;
            //         $index++;
            //     }
                
            // }
            // $drugs = Drug::whereIn('id',$drug_ids)->get();
            // foreach( $drugs as $drug){
            //     User::find(1)->notify(new DrugExipre($drug));
            

        // }
       

    }
}
