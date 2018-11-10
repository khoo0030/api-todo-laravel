<?php

namespace Tests\Feature\Factory;

use App\Models\Todo;
use Tests\TestCase;

class TodoFactoryTest extends TestCase
{
    /** @var Todo $instance */
    private $instance;

    protected function setUp()
    {
        parent::setUp();    // this is necessary for factories to work in setUp()

        $this->instance = factory(Todo::class)->create();
    }

    /** @test */
    public function can_create_an_instance()
    {
        $this->assertInstanceOf(Todo::class, $this->instance);
    }
}
