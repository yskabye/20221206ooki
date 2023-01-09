<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reserve;

class ReservesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'user_id' => 19,
            'restrant_id' => 1,
            'reserve_date' => '2023/01/07',
            'reserve_time' => '12:00',
            'people_num' => 3,
        ];
        Reserve::create($param);

        $param = [
            'user_id' => 21,
            'restrant_id' => 1,
            'reserve_date' => '2023/02/03',
            'reserve_time' => '18:30',
            'people_num' => 4,
        ];
        Reserve::create($param);
        
        $param = [
            'user_id' => 23,
            'restrant_id' => 1,
            'reserve_date' => '2023/01/25',
            'reserve_time' => '19:30',
            'people_num' => 6,
        ];
        Reserve::create($param);
        
        $param = [
            'user_id' => 18,
            'restrant_id' => 1,
            'reserve_date' => '2023/02/11',
            'reserve_time' => '18:30',
            'people_num' => 10,
        ];
        Reserve::create($param);
        
        $param = [
            'user_id' => 22,
            'restrant_id' => 1,
            'reserve_date' => '2023/01/21',
            'reserve_time' => '17:00',
            'people_num' => 1,
        ];
        Reserve::create($param);
        
        $param = [
            'user_id' => 24,
            'restrant_id' => 1,
            'reserve_date' => '2023/01/08',
            'reserve_time' => '16:30',
            'people_num' => 2,
        ];
        Reserve::create($param);
        
        $param = [
            'user_id' => 20,
            'restrant_id' => 1,
            'reserve_date' => '2023/01/18',
            'reserve_time' => '20:00',
            'people_num' => 5,
        ];
        Reserve::create($param);
        
        $param = [
            'user_id' => 18,
            'restrant_id' => 1,
            'reserve_date' => '2023/01/09',
            'reserve_time' => '11:30',
            'people_num' => 8,
        ];
        Reserve::create($param);
        
        $param = [
            'user_id' => 21,
            'restrant_id' => 1,
            'reserve_date' => '2023/01/16',
            'reserve_time' => '14:30',
            'people_num' => 7,
        ];
        Reserve::create($param);
        
        $param = [
            'user_id' => 24,
            'restrant_id' => 1,
            'reserve_date' => '2023/02/25',
            'reserve_time' => '12:30',
            'people_num' => 4,
        ];
        Reserve::create($param);
        
        $param = [
            'user_id' => 23,
            'restrant_id' => 1,
            'reserve_date' => '2023/01/13',
            'reserve_time' => '17:30',
            'people_num' => 2,
        ];
        Reserve::create($param);
        
        $param = [
            'user_id' => 20,
            'restrant_id' => 1,
            'reserve_date' => '2023/01/27',
            'reserve_time' => '21:00',
            'people_num' => 1,
        ];
        Reserve::create($param);
    }
}
