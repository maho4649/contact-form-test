<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'type',
        'content' 
    ];

    // アクセサ: name に first_name + last_name を返す
    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
