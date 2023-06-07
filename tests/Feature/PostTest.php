<?php

namespace Tests\Feature;

use App\Http\Controllers\PostController;
use App\Http\Repositories\PostRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Post;
use Tests\TestCase;

class PostTest extends TestCase
{
    // use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_index(): void
    {
        $response = $this->get(route('posts.index'));

        $response->assertStatus(200);
    }

    public function test_create(): void
    {
        $response = $this->get(route('posts.create'));

        $response->assertStatus(200);
    }

    public function test_store_post(): void
    {
        $post = $this->post(route('posts.store'), [
            'title' => 'title for test',
            'body' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ea sint, dicta dolorem vel at earum, eius commodi ab numquam maiores hic et ducimus nemo unde? Culpa nostrum rerum exercitationem optio!
            Dolores beatae excepturi earum, voluptates amet unde neque expedita provident consectetur saepe. Dolorum similique quaerat molestiae tempore consequatur veritatis amet quibusdam aut nisi eos modi saepe, cupiditate, ab laudantium quam.
            Delectus dolorum totam praesentium in ea sapiente beatae distinctio, doloribus cum dolor molestiae itaque quisquam quia quos nihil placeat suscipit repellat? Maxime blanditiis voluptatum aliquid tempore earum eum iusto quae.',
            'image' => 'https://picsum.photos/200/300'
        ]);

        // $post = PostController::store()

        $this->assertModelExists($post);
    }

    public function test_edit_post()
    {
        $post = Post::factory()->create();

        $response = $this->get(route('posts.edit', $post->id));

        $response->assertStatus(200);
    }

    public function test_update_post(): void
    {
        $post = Post::factory()->create();

        $response = $this->put(route('posts.update', $post->id), [
            'title' => '(updated!!) title for test',
            'body' => '(updated!!) Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ea sint, dicta dolorem vel at earum, eius commodi ab numquam maiores hic et ducimus nemo unde? Culpa nostrum rerum exercitationem optio!
            Dolores beatae excepturi earum, voluptates amet unde neque expedita provident consectetur saepe. Dolorum similique quaerat molestiae tempore consequatur veritatis amet quibusdam aut nisi eos modi saepe, cupiditate, ab laudantium quam.
            Delectus dolorum totam praesentium in ea sapiente beatae distinctio, doloribus cum dolor molestiae itaque quisquam quia quos nihil placeat suscipit repellat? Maxime blanditiis voluptatum aliquid tempore earum eum iusto quae.',
            'image' => 'https://picsum.photos/200/300'
        ]);

        $response->assertStatus(200);
    }

    public function test_delete_post(): void
    {
        $post = Post::factory()->create();

        $response = $this->delete(route('posts.destroy', $post->id));

        $response->assertStatus(200);
    }


    // =================================
    // ================= database tests!!
    // =================================

    public function test_store(): void
    {
        $post = Post::factory()->create();

        $this->assertModelExists($post);
    }

    public function test_delete(): void
    {
        $post = Post::factory()->create();

        $post->delete();

        $this->assertModelMissing($post);
    }
}
