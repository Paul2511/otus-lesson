<?php


namespace Tests\Feature\Http\Controllers\Api\File;

use App\Http\Controllers\Controller;
use App\Http\RouteNames;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use Tests\AuthAttach;
use Illuminate\Support\Facades\Storage;

class ApiFileControllerUploadImageTest extends TestCase
{
    use AuthAttach;


    /**
     * Гость не имеет права на аплоад
     * @group fileUpload
     */
    public function testDenied401()
    {
        $data = [
            'image' => UploadedFile::fake()->image('тестовый_файл.jpg'),
        ];

        $response = $this->json('post', route(RouteNames::UPLOAD_IMAGE), $data);

        $response->assertStatus(401);
    }


    /**
     * Нет файла в запросе
     * @group fileUpload
     */
    public function testWithoutFile422()
    {
        $user = $this->currentUser();

        $data = [
            'uploadPath' => 'user.avatar',
            'userId' => $user->id
        ];

        $response = $this->tokenHeader()->json('post', route(RouteNames::UPLOAD_IMAGE), $data);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors(['image']);
    }

    /**
     * Файл не изображение
     * @group fileUpload
     */
    public function testWrongFile422()
    {
        $user = $this->currentUser();

        $data = [
            'image' => UploadedFile::fake()->create('тестовый_файл.pdf', 1028),
            'uploadPath' => 'user.avatar',
            'userId' => $user->id
        ];

        $response = $this->tokenHeader()->json('post', route(RouteNames::UPLOAD_IMAGE), $data);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors(['image']);
    }


    /**
     * Размер файла превышает лимит
     * @group fileUpload
     */
    public function testWrongFileSize422()
    {
        $user = $this->currentUser();

        $data = [
            'image' => UploadedFile::fake()->create('тестовый_файл.jpg', 30000),
            'uploadPath' => 'user.avatar',
            'userId' => $user->id
        ];

        $response = $this->tokenHeader()->json('post', route(RouteNames::UPLOAD_IMAGE), $data);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors(['image']);
    }


    /**
     * Удачный аплоад
     * @group fileUpload
     */
    public function testSuccess200()
    {
        $user = $this->currentUser();

        $data = [
            'image' => UploadedFile::fake()->image('тестовый_файл.jpg'),
            'uploadPath' => 'user.avatar',
            'userId' => $user->id
        ];

        $response = $this->tokenHeader()->json('post', route(RouteNames::UPLOAD_IMAGE), $data);

        $response->assertStatus(Controller::JSON_STATUS_OK)
            ->assertJsonStructure(['data']);

        $result = json_decode($response->getContent(), true);

        $fileData = $result['data'];

        Storage::disk($fileData['disk'])->assertExists($fileData['path']);
    }


}