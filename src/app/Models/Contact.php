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

   public function getNameAttribute($value)
    {
        return $value;
    }


    // 問い合わせ種別のラベル化
    public function getTypeLabelAttribute()
    {
        $typeMap = [
            'product_delivery' => '商品のお届けについて',
            'product_exchange' => '商品の交換について',
            'product_issue' => '商品トラブル',
            'shop_inquiry' => 'ショップへのお問い合わせ',
            'other' => 'その他',
        ];

        return $typeMap[$this->type] ?? '不明';
    }
}
