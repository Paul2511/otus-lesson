<?php


namespace Http\Controllers\Desk;


use Tests\Generators\ColumnGenerator;
use Tests\TestCase;

class ColumnControllerStoreTest extends TestCase
{
    /**
     * @group column
     */
    public function testStoreColumn()
    {
        $data = ColumnGenerator::generateTestColumn()->toArray();

        $this->post(route('column.store'), $data);
        $this->assertDatabaseHas('columns', [
            'title' => 'test',
        ]);
    }
}
