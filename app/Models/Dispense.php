<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispense extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function user($id){
        return User::find($id);
    }
    public function drug($id){
        return Drug::find($id);
    }
}
