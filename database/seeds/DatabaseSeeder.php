<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CustomersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(CategoryProductsTableSeeder::class);
        $this->call(MyCountryTableSeeder::class);
        $this->call(CustomerAddressesTableSeeder::class);
        $this->call(CourierTableSeeder::class);
        $this->call(OrderStatusTableSeeder::class);
        $this->call(BrandsTableSeeder::class);
        $this->call(AttributeTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
    }
}
