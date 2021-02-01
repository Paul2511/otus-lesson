<?php


namespace Http\Controllers\Desk;


use Illuminate\Http\Response;
use Tests\Generators\ColumnGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class ColumnControllerStoreTest extends TestCase
{
    /**
     * @group column
     */
    public function testStoreColumn()
    {
        $data = ColumnGenerator::generateTestColumn();
        $admin = UserGenerator::generateAdmin();

        $response = $this->actingAs($admin)->post(route('column.store'), $data->toArray());
//        dd($response);
        $response->assertStatus(Response::HTTP_FOUND);
    }
}
