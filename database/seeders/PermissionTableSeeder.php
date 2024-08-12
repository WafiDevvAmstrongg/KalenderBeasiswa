<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions =[
            'kalender-list',
            'kalender-create',
            'kalender-edit',
            'kalender-delete',
            'artikel-list',
            'artikel-create',
            'artikel-edit',
            'artikel-delete',
        ];
    }
}
