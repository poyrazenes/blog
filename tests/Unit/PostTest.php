<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class PostTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_can_show_post()
    {
        $link = Config::get('core.app.domains.api') . '/posts/11';
        $this->get($link)->assertStatus(200);
    }

    public function test_can_list_posts()
    {
        $link = Config::get('core.app.domains.api') . '/posts';

        $this->get($link)->assertStatus(200);
    }
}
