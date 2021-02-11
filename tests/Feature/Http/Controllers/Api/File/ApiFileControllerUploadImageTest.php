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

        $response = $this->json('post', route(RouteNames::V1_UPLOAD_IMAGE), $data);

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
            'id' => $user->id
        ];

        $response = $this->tokenHeader()->json('post', route(RouteNames::V1_UPLOAD_IMAGE), $data);

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
            'id' => $user->id
        ];

        $response = $this->tokenHeader()->json('post', route(RouteNames::V1_UPLOAD_IMAGE), $data);

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
            'id' => $user->id
        ];

        $response = $this->tokenHeader()->json('post', route(RouteNames::V1_UPLOAD_IMAGE), $data);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors(['image']);
    }


    /**
     * Удачный аплоад пользовательского аватара
     * @group fileUpload
     */
    public function testUploadAvatarSuccess200()
    {
        $user = $this->currentUser();

        $data = [
            'image' => UploadedFile::fake()->image('тестовый_файл.jpg'),
            'uploadPath' => 'user.avatar',
            'id' => $user->id
        ];

        $response = $this->tokenHeader()->json('post', route(RouteNames::V1_UPLOAD_IMAGE), $data);

        $response->assertStatus(Controller::JSON_STATUS_OK)
            ->assertJsonStructure(['data']);

        $result = json_decode($response->getContent(), true);

        $fileData = $result['data'];

        Storage::disk($fileData['disk'])->assertExists($fileData['path']);
    }

    /**
     * Удачный аплоад фотографии питомца
     * @group fileUpload
     */
    public function testUploadPhotoSuccess200()
    {
        $user = $this->currentUser();
        $pet = $this->generatePet(5, [
            'client_id' => $user->client->id
        ])->random();

        $data = [
            'image' => UploadedFile::fake()->image('тестовый_файл.jpg'),
            'uploadPath' => 'pet.photo',
            'id' => $pet->id
        ];

        $response = $this->tokenHeader()->json('post', route(RouteNames::V1_UPLOAD_IMAGE), $data);

        $response->assertStatus(Controller::JSON_STATUS_OK)
            ->assertJsonStructure(['data']);

        $result = json_decode($response->getContent(), true);

        $fileData = $result['data'];
        Storage::disk($fileData['disk'])->assertExists($fileData['path']);
    }

}