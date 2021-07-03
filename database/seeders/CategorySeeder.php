<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insertOrIgnore([
            ['name' => 'Cate1'],
            ['name' => 'Cate2'],
            ['name' => 'Cate3'],


        ]);
    }
}
