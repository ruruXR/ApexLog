<?php

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
        $bodydammy = 'この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。';
        $commentdammy = 'コメントはダミーだよ。ダミーコメントです。';
        
        for ($i = 1; $i < 51; $i++) 
        {
            \App\Post::create([
                'user_id' => 1,
                'category_id' => 1,
                'subject' => $i.'番目の投稿',
                'message' => $bodydammy,
                'name' => '名無しさん',
            ]);
            
            for ($j = 1; $j < 21; $j++)
            {
            \App\Comment::create([
                'post_id' => $i,
                'name' => '名無しさん',
                'comment' => $commentdammy,
                ]);
            }
        }
            
        \App\Category::create([
            'name' => 'オリンパス',
            ]);
    }
}
