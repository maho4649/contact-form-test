<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Contact;

class ContactSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('ja_JP'); // Faker インスタンスの作成

        for ($i = 0; $i < 35; $i++) { // 35件のダミーデータを作成
            Contact::create([
                'name' => $faker->name,
                'gender' => $faker->randomElement(['男性', '女性']),
                'email' => $faker->email,
                'tel' => $faker->numerify('###-###-####'), // 電話番号
                'address' => $faker->address,
                'building' => $faker->secondaryAddress ?? '',
                'type' => $faker->randomElement(['商品のお届けについて', '商品の交換について', '商品トラブル','ショップへのお問い合わせ', 'その他']),
                'content' => $faker->text(100),
                
            ]);
        }
    }
}
