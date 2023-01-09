<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*$param = [
            'name' => '管理者',
            'email' => 'admin@resa.co.jp',
            'password' => bcrypt('password'),
            'type_id'  => 9
        ];
        User::create($param);*/

        /*$param = [
            'name' => '青木 道康',
            'email' => 'store01@resa.co.jp',
            'password' => bcrypt('password'),
            'type_id'  => 5,
            'restrant_id' => 1,
        ];
        User::create($param);

        $param = [
            'name' => '長野 裕一',
            'email' => 'store02@resa.co.jp',
            'password' => bcrypt('password'),
            'type_id'  => 5,
            'restrant_id' => 2,
        ];
        User::create($param);

        $param = [
            'name' => '佐藤 純平',
            'email' => 'store03@resa.co.jp',
            'password' => bcrypt('password'),
            'type_id'  => 5,
            'restrant_id' => 3,
        ];
        User::create($param);

        $param = [
            'name' => '七瀬 恭子',
            'email' => 'store04@resa.co.jp',
            'password' => bcrypt('password'),
            'type_id'  => 5,
            'restrant_id' => 4,
        ];
        User::create($param);

        $param = [
            'name' => '岡 智子',
            'email' => 'store05@resa.co.jp',
            'password' => bcrypt('password'),
            'type_id'  => 5,
            'restrant_id' => 5,
        ];
        User::create($param);

        $param = [
            'name' => '美川 透',
            'email' => 'store06@resa.co.jp',
            'password' => bcrypt('password'),
            'type_id'  => 5,
            'restrant_id' => 6,
        ];
        User::create($param);

        $param = [
            'name' => '高尾 洋介',
            'email' => 'store07@resa.co.jp',
            'password' => bcrypt('password'),
            'type_id'  => 5,
            'restrant_id' => 7,
        ];
        User::create($param);

        $param = [
            'name' => '高橋 淳平',
            'email' => 'store08@resa.co.jp',
            'password' => bcrypt('password'),
            'type_id'  => 5,
            'restrant_id' => 8,
        ];
        User::create($param);

        $param = [
            'name' => '山本 瞬',
            'email' => 'store09@resa.co.jp',
            'password' => bcrypt('password'),
            'type_id'  => 5,
            'restrant_id' => 9,
        ];
        User::create($param);

        $param = [
            'name' => '米持 和樹',
            'email' => 'store10@resa.co.jp',
            'password' => bcrypt('password'),
            'type_id'  => 5,
            'restrant_id' => 10,
        ];
        User::create($param);

        $param = [
            'name' => '高橋 真純',
            'email' => 'store11@resa.co.jp',
            'password' => bcrypt('password'),
            'type_id'  => 5,
            'restrant_id' => 11,
        ];
        User::create($param);

        $param = [
            'name' => '荒川 文子',
            'email' => 'store12@resa.co.jp',
            'password' => bcrypt('password'),
            'type_id'  => 5,
            'restrant_id' => 12,
        ];
        User::create($param);

        $param = [
            'name' => '廣瀬 勝',
            'email' => 'store13@resa.co.jp',
            'password' => bcrypt('password'),
            'type_id'  => 5,
            'restrant_id' => 13,
        ];
        User::create($param);

        $param = [
            'name' => '塚本 政浩',
            'email' => 'store14@resa.co.jp',
            'password' => bcrypt('password'),
            'type_id'  => 5,
            'restrant_id' => 14,
        ];
        User::create($param);

        $param = [
            'name' => '石原 洋',
            'email' => 'store15@resa.co.jp',
            'password' => bcrypt('password'),
            'type_id'  => 5,
            'restrant_id' => 15,
        ];
        User::create($param);

        $param = [
            'name' => '松尾 明',
            'email' => 'store16@resa.co.jp',
            'password' => bcrypt('password'),
            'type_id'  => 5,
            'restrant_id' => 16,
        ];
        User::create($param);*/

        $param = [
            'name' => '高瀬 友美',
            'email' => 'takase_48@example.ne.jp',
            'password' => bcrypt('password'),
            'type_id'  => 0,
        ];
        User::create($param);

        $param = [
            'name' => '沖田 千明',
            'email' => 'chiakiokita@example.org',
            'password' => bcrypt('password'),
            'type_id'  => 0,
        ];
        User::create($param);

        $param = [
            'name' => '足立 邦彦',
            'email' => 'adachi_kunihiko@example.net',
            'password' => bcrypt('password'),
            'type_id'  => 0,
        ];
        User::create($param);

        $param = [
            'name' => '吉澤 あけみ',
            'email' => 'akemi_yoshizawa@example.net',
            'password' => bcrypt('password'),
            'type_id'  => 0,
        ];
        User::create($param);

        $param = [
            'name' => '中西 安紀子',
            'email' => 'akikonakanishi@example.co.jp',
            'password' => bcrypt('password'),
            'type_id'  => 0,
        ];
        User::create($param);

        $param = [
            'name' => '郭 奈未',
            'email' => 'nami_kaku@example.com',
            'password' => bcrypt('password'),
            'type_id'  => 0,
        ];
        User::create($param);

        $param = [
            'name' => '福田 伸一',
            'email' => 'fukuda97@example.net',
            'password' => bcrypt('password'),
            'type_id'  => 0,
        ];
        User::create($param);


    }
}
