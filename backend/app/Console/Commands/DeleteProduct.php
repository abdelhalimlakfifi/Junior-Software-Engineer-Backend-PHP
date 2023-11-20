<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
class DeleteProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $id = $this->ask('Enter the product id to delete: ');

        $product = Product::find($id);

        if (!$product) {
            $this->error('Product not found.');
            return;
        }

        $name = $product->name;


        // Confirm deletion
        if ($this->confirm("Are you sure you want to delete the product '{$name}'?")) {
            $product->delete();
            $this->info('Product deleted successfully!');
        } else {
            $this->info('Product deletion canceled.');
        }
    }
}
