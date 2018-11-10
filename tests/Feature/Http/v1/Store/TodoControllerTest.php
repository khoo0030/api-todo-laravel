<?php

namespace Tests\Feature\Http\v1\Store;

use Faker\Factory;
use Faker\Generator;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class TodoControllerTest extends TestCase
{
    private const URI = '/api/v1/todos';

    /** @var Generator $faker */
    private $faker;

    protected function setUp()
    {
        parent::setUp();    // this is necessary for factories to work in setUp()

        $this->faker = Factory::create();
    }

    /** @test */
    public function should_200()
    {
        $todoTitle = $this->faker->sentence(6);

        $response = $this->json('POST', self::URI, [
            'title' => $todoTitle,
        ]);

        $response->assertStatus(Response::HTTP_CREATED);

        $responseBody = $response->decodeResponseJson();
        $this->assertEquals($todoTitle, $responseBody['data']['title']);
    }

    /** @test */
    public function should_422_when_todo_title_is_not_in_request_body()
    {
        $response = $this->json('POST', self::URI, []);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function should_422_when_todo_title_is_empty()
    {
        $response = $this->json('POST', self::URI, [
            'title' => null,
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
