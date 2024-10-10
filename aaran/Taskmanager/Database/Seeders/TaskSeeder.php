<?php

namespace Aaran\Taskmanager\Database\Seeders;

use Aaran\Taskmanager\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public static function run(): void
    {
        Task::create([
            'slno' => '1',
            'date' => '2024-3-16',
            'vname' => 'my first todo',
            'completed' => 'false',
            'active_id' => '1',
        ]);
    }
}
