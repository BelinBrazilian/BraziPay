<?php

namespace Tests\Feature;

use Tests\TestCase;

class InspireCommandTest extends TestCase
{
    public function test_inspire_command_outputs_quote()
    {
        $this->artisan('inspire')
            ->expectsOutputToContain('“')
            ->assertExitCode(0);
    }
}
