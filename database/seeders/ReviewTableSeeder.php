<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;

class ReviewTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*$param = [
                'reserve_id' => 1,
                'values' => 4,
                'comment' => '久々にゆっくりくつろいで、食事できました。\nまた、行きたいですね。',
        ];
        Review::create($param);

        $param = [
                'reserve_id' => 6,
                'values' => 5,
                'comment' => '大変美味しかったですね。機会があれば、また味わいたいですね。',
        ];
        Review::create($param);

        $param = [
                'reserve_id' => 8,
                'values' => 3,
                'comment' => '至って、普通に美味しかったですよ。',
        ];
        Review::create($param);*/

        $param = [
                'reserve_id' => 11,
                'values' => 2,
                'comment' => '値段が高すぎてくつろげなかった（泣)',
        ];
        Review::create($param);

        $param = [
                'reserve_id' => 9,
                'values' => 1,
                'comment' => '俺に口には少なくとも合わん！',
        ];
        Review::create($param);

        $param = [
                'reserve_id' => 12,
                'values' => 5,
                'comment' => '価格相応でした。また、利用します。',
        ];
        Review::create($param);
    }
}
