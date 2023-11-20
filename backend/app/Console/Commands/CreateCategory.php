<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Category;

class CreateCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-category';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new category';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->ask('Enter the category name: ');
        $parentName = $this->ask('Enter the category parent name (nullable): ');

        // Find the parent category if provided
        $parent = null;
        if ($parentName !== null) {
            $parent = Category::where('name', $parentName)->first();

            if (!$parent) {
                $this->error('Category parent not found.');
                return;
            }
        }

        // Create the category
        $category = Category::create([
            'name' => $name,
            'parent_category_id' => $parent ? $parent->id : null,
        ]);

        $this->info('Category created successfully!');
        $this->info('Category Name: ' . $category->name);

        if ($parent) {
            $this->info('Parent Category: ' . $parent->name);
        }
    }
}
