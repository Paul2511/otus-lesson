<?php


namespace Http\Controllers\Desk;


use Illuminate\Http\Response;
use Tests\Generators\ColumnGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class ColumnControllerDestroyTest extends  TestCase
{
    /**
     * @group column
     */
    public function testDestroyColumn()
    {
        $column = ColumnGenerator::generateTestColumn();
        $admin = UserGenerator::generateAdmin();

        $response = $this->actingAs($admin)->delete(route('column.destroy', ['column' => $column->id]));
//        dd($response);
        $response->assertStatus(Response::HTTP_FOUND);
    }

}
