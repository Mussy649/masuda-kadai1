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
        $category = Category::inRandomOrder()->first();

        $details = [
            '商品のお届けについて' => [
                '商品の到着予定日を教えてください。',
                '配送状況を確認したいです。',
                '指定した日時に商品を受け取ることはできますか。',
                '配送先住所を変更したいです。',
            ],
            '商品の交換について' => [
                '商品のサイズ交換をお願いしたいです。',
                'カラーを変更して交換することはできますか。',
                '交換手続きの流れを教えてください。',
                '交換時の送料について確認したいです。',
            ],
            '商品トラブル' => [
                '届いた商品に不具合がありました。',
                '注文した商品と違うものが届きました。',
                '商品の一部が破損していました。',
                '商品に汚れがあったため確認をお願いします。',
            ],
            'ショップへのお問い合わせ' => [
                '店舗の営業時間について確認したいです。',
                '在庫状況を確認したい商品があります。',
                'ショップへの問い合わせをお願いします。',
                '店舗での受け取りが可能か確認したいです。',
            ],
            'その他' => [
                'その他、確認したいことがあります。',
                '会員情報について確認したいです。',
                '注文内容について相談したいです。',
                'キャンペーンについて詳しく知りたいです。',
            ],
        ];

        return [
            'category_id' => $category->id,
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'gender' => $this->faker->numberBetween(1, 3),
            'email' => $this->faker->unique()->safeEmail(),
            'tel' => $this->faker->numerify('0##########'),
            'address' => $this->faker->address(),
            'building' => $this->faker->optional()->secondaryAddress(),
            'detail' => $this->faker->randomElement($details[$category->content]),
        ];
    }
}