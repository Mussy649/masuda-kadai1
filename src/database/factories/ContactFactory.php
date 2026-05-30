<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition()
    {
        $lastNames = ['山田', '佐藤', '鈴木', '田中', '高橋', '伊藤', '渡辺', '中村'];
        $firstNames = ['太郎', '花子', '一郎', '明', '美咲', '健太', '彩', '直樹'];

        $addresses = [
            '東京都渋谷区千駄ヶ谷1-2-3',
            '東京都港区南青山2-3-4',
            '東京都新宿区西新宿3-4-5',
            '東京都世田谷区三軒茶屋1-5-6',
            '東京都目黒区自由が丘2-6-7',
        ];

        $buildings = [
            '千駄ヶ谷マンション101',
            '青山レジデンス202',
            '西新宿ビル301',
            '三軒茶屋ハイツ403',
            '',
        ];

        $details = [
            '商品の到着予定日を教えてください。',
            '交換方法について確認したいです。',
            '商品に不具合がありました。',
            'ショップへの問い合わせです。',
            'その他、確認したいことがあります。',
        ];

        return [
            'category_id' => Category::inRandomOrder()->value('id'),
            'first_name' => $this->faker->randomElement($firstNames),
            'last_name' => $this->faker->randomElement($lastNames),
            'gender' => $this->faker->numberBetween(1, 3),
            'email' => $this->faker->unique()->safeEmail(),
            'tel' => $this->faker->numerify('080########'),
            'address' => $this->faker->randomElement($addresses),
            'building' => $this->faker->randomElement($buildings),
            'detail' => $this->faker->randomElement($details),
        ];
    }
}