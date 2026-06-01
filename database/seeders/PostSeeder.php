<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Post;


class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { 
        /*
      
        /* for ($i = 0; $i < 30; $i++) {
        // $title = Str::random(20); // equivalente con el facade
            $title = str()->random(20);
            $c = Category::inRandomOrder()->first();
            Post::create(
                    [
                    'title' => $title,             
                    //'slug' => Str::slug($title), 
                    'slug' => str($title)->slug(),
                    'content' => "<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Vitae 
                    aperiam culpa veritatis quasi laudantium mollitia quidem est blanditiis ullam illum cupiditate 
                    suscipit, quia, itaque quaerat? Iure debitis laudantium aliquam maxime!</p>",
                    'category_id' => $c->id,
                    'description' => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Vitae ",
                    'posted' => "yes"
                ]);
        } */

          Post::factory(30)->create();
    }
}
