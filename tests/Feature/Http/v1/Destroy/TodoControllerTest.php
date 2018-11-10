<?php

namespace Tests\Feature\Http\v1\Destroy;

use App\Models\Todo;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class TodoControllerTest extends TestCase
{
    private const URI = '/api/v1/todos';

    /** @var Todo $todo */
    private $todo;

    protected function setUp()
    {
        parent::setUp();    // this is necessary for factories to work in setUp()

        $this->todo = factory(Todo::class)->create();
    }

    private function getUri(int $id): string
    {
        return self::URI . '/' . $id;
    }

    /** @test */
    public function should_404_when_todo_resource_does_not_exists()
    {
        $response = $this->json('DELETE', $this->getUri($this->todo->id + 1));

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    /** @test */
    public function should_204()
    {
        $response = $this->json('DELETE', $this->getUri($this->todo->id));

        $response->assertStatus(Response::HTTP_NO_CONTENT);

        $todo = (new Todo)->find($this->todo->id);
        $this->assertEquals(null, $todo);
    }
}
