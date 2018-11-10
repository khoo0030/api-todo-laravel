<?php

namespace Tests\Feature\Http\v1\Update;

use App\Models\Todo;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class TodoControllerTest extends TestCase
{
    private const URI = '/api/v1/todos';

    /** @var Generator $faker */
    private $faker;

    /** @var Todo $todo */
    private $todo;

    protected function setUp()
    {
        parent::setUp();    // this is necessary for factories to work in setUp()

        $this->faker = Factory::create();

        $this->todo = factory(Todo::class)->create();
    }

    private function getUri(int $id): string
    {
        return self::URI . '/' . $id;
    }

    /** @test */
    public function should_404_when_todo_resource_does_not_exists()
    {
        $response = $this->json('GET', $this->getUri($this->todo->id + 1));

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    /** @test */
    public function should_200()
    {
        $newTodoTitle = $this->faker->sentence(6);

        $response = $this->json('PATCH', $this->getUri($this->todo->id), [
            'title' => $newTodoTitle,
        ]);

        $response->assertStatus(Response::HTTP_OK);

        $responseBody = $response->decodeResponseJson();
        $this->assertEquals($newTodoTitle, $responseBody['data']['title']);
    }

    /** @test */
    public function should_422_when_todo_title_is_not_in_request_body()
    {
        $response = $this->json('PATCH', $this->getUri($this->todo->id), []);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function should_422_when_todo_title_is_empty()
    {
        $response = $this->json('PATCH', $this->getUri($this->todo->id), [
            'title' => null,
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
