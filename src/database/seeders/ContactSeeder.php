<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Contact;

class ContactSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create(); // Faker インスタンスの作成

        for ($i = 0; $i < 10; $i++) { // 10件のダミーデータを作成
            Contact::create([
                'name' => $faker->name,
                'gender' => $faker->randomElement(['male', 'female']),
                'email' => $faker->email,
                'tel' => $faker->numerify('###-###-####'), // 電話番号
                'address' => $faker->address,
                'building' => $faker->secondaryAddress ?? '',
                'type' => $faker->randomElement(['product_inquiry', 'order_inquiry', 'shipping_inquiry', 'other']),
                'content' => $faker->text(100),
            ]);
        }
    }
}
