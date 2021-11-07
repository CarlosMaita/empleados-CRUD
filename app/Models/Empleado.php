<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Empleado extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'lastname', 'email', 'photo']  ;


    public function getUrlPhoto(){
        $url = asset(Storage::url($this->photo));
        return $url;
    }
}
