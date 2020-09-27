<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
//        factory(\App\User::class,500)->create();
//        factory(\App\Address::class,1000)->create();
 //    factory(\App\Product::class,1500)->create();
//  factory(\App\Image::class,3500)->create();
   factory(\App\Review::class,3500)->create();
  //      factory(\App\Categories::class,50)->create();
        //factory(\App\Tag::class,150)->create();
        //factory(\App\Ticket::class,150)->create();
    }
}
