<?php

namespace Database\Seeders;

use App\Models\Column;
use Illuminate\Database\Seeder;

class ColumnTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('columns')->insert([
            ["title" => "Back Log", "slug" => "back_log", "created_at" => now(), "updated_at" => now()],
            ["title" => "In Progress", "slug" => "in_progress", "created_at" => now(), "updated_at" => now()],
            ["title" => "Tested", "slug" => "tested", "created_at" => now(), "updated_at" => now()],
            ["title" => "Done", "slug" => "done", "created_at" => now(), "updated_at" => now()],
        ]);
    }
}
