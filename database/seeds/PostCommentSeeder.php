<?php

use App\Post;
use App\Comment;
use Illuminate\Database\Seeder;

class PostCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Post::class, 50)->create();
        factory(Comment::class, 200)->create();
            
        \App\Category::create([
            'name' => 'オリンパス',
            ]);
        \App\Category::create([
            'name' => 'ワールズエッジ',
            ]);
        \App\Category::create([
            'name' => 'キングズキャニオン',
            ]);
        \App\Category::create([
            'name' => 'アリーナ',
            ]);
        \App\Category::create([
            'name' => 'その他',
            ]);
    }
}
