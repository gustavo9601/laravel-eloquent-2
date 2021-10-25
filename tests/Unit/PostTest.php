<?php

namespace Tests\Unit;

use App\Post;
use App\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tests\TestCase;

class PostTest extends TestCase
{
    /**
     * @test
     * @testdox Un post pertenece a un autor
     */
    function a_post_belongs_to_an_author()
    {
        // $this->markTestIncomplete();

        $user = factory(User::class)->create();
        $post = factory(Post::class)->create([
            'author_id' => $user->id,
        ]);

        $this->assertInstanceOf(BelongsTo::class, $post->author());
        $this->assertInstanceOf(User::class, $post->author);
        $this->assertTrue($post->author->is($user));
    }

    /**
     * @test
     * @testdox Exporta el título, contenido, fecha y estado de publicación de los posts.
     */
    function exports_the_title_content_published_date_and_status_of_the_posts()
    {
        $post = factory(Post::class)->create([
            'title' => 'Título del post',
            'content' => 'Contenido del post',
            'published_at' => '2020-09-01 12:00:00',
        ]);

        $expected = [
            'title' => 'Título del post',
            'content' => 'Contenido del post',
            'published_at' => '01/09/2020 12:00',
        ];

        $this->assertSame($expected, $post->toArray());
        $this->assertSame(json_encode($expected), $post->toJson());
    }

}
