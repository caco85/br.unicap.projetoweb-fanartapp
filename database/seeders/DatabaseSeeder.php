<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use App\Models\User;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
        ]);
    }
}
class UserSeeder extends Seeder
{
    public function run()
    {
        $users = User::get();

        if($users->count() == 0){
            DB::table('User')->insert([
                'name'=>'Administrador',
                'email'=>'admin@fanart.com.br',
                'password'=>bcrypt('12345678'),
                'type'=>'admin',
                'birthday'=>'1985-10-01',
                'created_at' => '2021-05-05 18:58:56',
                'updated_at' =>'2021-05-05 18:58:56',
            ]);
        }
    }

}
class CategorySeeder extends Seeder
{
    public function run()
    {
        $Category = Category::get();

        if($Category->count() == 0 && $Category->count() < 8){
            DB::table('Category')->insert([
                'type'=>'Anime',
                'created_at' => '2021-05-05 18:58:56',
                'updated_at' =>'2021-05-05 18:58:56',
            ]);
            DB::table('Category')->insert([
                'type'=>'Cartoon',
                'created_at' => '2021-05-05 18:58:56',
                'updated_at' =>'2021-05-05 18:58:56',

            ]);
            DB::table('Category')->insert([
                'type'=>'Free',
                'created_at' => '2021-05-05 18:58:56',
                'updated_at' =>'2021-05-05 18:58:56',
            ]);
            DB::table('Category')->insert([
                'type'=>'Game',
                'created_at' => '2021-05-05 18:58:56',
                'updated_at' =>'2021-05-05 18:58:56',

            ]);
            DB::table('Category')->insert([
                'type'=>'HQ',
                'created_at' => '2021-05-05 18:58:56',
                'updated_at' =>'2021-05-05 18:58:56',
            ]);
            DB::table('Category')->insert([
                'type'=>'Mangá',
                'created_at' => '2021-05-05 18:58:56',
                'updated_at' =>'2021-05-05 18:58:56',

            ]);
            DB::table('Category')->insert([
                'type'=>'Movie',
                'created_at' => '2021-05-05 18:58:56',
                'updated_at' =>'2021-05-05 18:58:56',
            ]);
            DB::table('Category')->insert([
                'type'=>'Series',
                'created_at' => '2021-05-05 18:58:56',
                'updated_at' =>'2021-05-05 18:58:56',

            ]);

        }
    }
}
