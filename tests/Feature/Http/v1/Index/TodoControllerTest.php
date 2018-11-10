<?php

namespace Tests\Feature\Http\v1\Index;

use App\Models\Todo;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class TodoControllerTest extends TestCase
{
    private const URI = '/api/v1/todos';

    /** @var Todo $todo1 */
    private $todo1;

    /** @var Todo $todo2 */
    private $todo2;

    protected function setUp()
    {
        parent::setUp();    // this is necessary for factories to work in setUp()

        $this->todo1 = factory(Todo::class)->create();
        $this->todo2 = factory(Todo::class)->create();
    }

    /** @test */
    public function should_200()
    {
        $response = $this->json('GET', self::URI);

        $response->assertStatus(Response::HTTP_OK);

        $responseBody = $response->decodeResponseJson();
        $this->assertEquals(2, count($responseBody['data']));
        $this->assertEquals($this->todo1->id, $responseBody['data'][0]['id']);
        $this->assertEquals($this->todo2->id, $responseBody['data'][1]['id']);
    }
}
