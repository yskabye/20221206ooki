<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Type;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'id' => 0,
            'name' => '利用者',
        ];
        Type::create($param);

        $param = [
            'id' => 5,
            'name' => '店舗代表者',
        ];
        Type::create($param);

        $param = [
            'id' => 9,
            'name' => '管理者',
        ];
        Type::create($param);

    }
}