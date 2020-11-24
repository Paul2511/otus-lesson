<?php

use App\Models\File;
use Illuminate\Database\Seeder;

class FileSeeder extends Seeder
{
    public function run(): void
    {
        factory(File::class, 10)->create();
    }
}
