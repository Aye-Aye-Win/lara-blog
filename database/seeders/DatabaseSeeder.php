<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
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
        $mgmg=User::factory()->create(['name'=>'mgmg','username'=>'mgmg']);
        $aungaung=User::factory()->create(['name'=>'aung','username'=>'aung']);
        $frontend=Category::factory()->create(['name'=>'frontend','slug'=>'frontend']);
        $backend=Category::factory()->create(['name'=>'backend','slug'=>'backend']);
        Blog::factory(20)->create(['category_id'=>$frontend->id,'user_id'=>$mgmg->id]);
        Blog::factory(10)->create(['category_id'=>$backend->id,'user_id'=>$aungaung->id]);
    }
}