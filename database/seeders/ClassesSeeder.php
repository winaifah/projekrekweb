<?php

namespace Database\Seeders;

use App\Models\Classes; // Impor model Classes
use App\Models\Section; // Impor model Section
use App\Models\Student; // Impor model Student
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Classes::factory()
            ->count(10)
            ->sequence(fn($sequence) => ['name' => 'Class' . $sequence->index + 1])
            ->has(
                Section::factory()
                ->count(4)
                ->state(
                    new Sequence(
                        ['name' => 'Section A'],
                        ['name' => 'Section B'],
                    )
                )
                ->has(
                    Student::factory()
                    ->count(5)
                    ->state(
                        function (array $attributes, Section $section){
                            return['class_id' => $section->class_id];
                        }
                    )
                )
            )
            ->create();
    }
}
