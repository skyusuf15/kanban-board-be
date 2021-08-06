<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\Column;
use Illuminate\Database\Seeder;

class CardTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $defaultCol = Column::first();
        \DB::table('cards')->insert([
            [
                "title" => "Log in page",
                "description" => "Some test here",
                "column_id" => $defaultCol->id,
                "created_at" => now(), "updated_at" => now()
            ],
            [
                "title" => "Fix bug on sign up page",
                "description" => "Some test here",
                "column_id" => $defaultCol->id,
                "created_at" => now(), "updated_at" => now()
            ],
        ]);
    }
}
