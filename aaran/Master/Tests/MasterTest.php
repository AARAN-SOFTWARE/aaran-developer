<?php

namespace Aaran\Master\Tests;

use Aaran\Master\Models\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class MasterTest extends TestCase
{
    use DatabaseMigrations;

    public function test_bank_table(): void
    {
        $master = Product::factory()->create();

        $obj = Product::find($master->id);

        $this->assertEquals($master->vname, actual: $obj->vname);
        $this->assertEquals($master->active_id, actual: $obj->active_id);
    }
}
