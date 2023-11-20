<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Category;

class DeleteCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-category';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete a category by name';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->ask('Enter the category name to delete: ');

        // Find the category by name
        $category = Category::where('name', $name)->first();

        if (!$category) {
            $this->error('Category not found.');
            return;
        }

        // Confirm deletion
        if ($this->confirm("Are you sure you want to delete the category '{$name}'?")) {
            $category->delete();
            $this->info('Category deleted successfully!');
        } else {
            $this->info('Category deletion canceled.');
        }
    }
}
