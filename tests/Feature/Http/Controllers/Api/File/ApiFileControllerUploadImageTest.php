<?php


namespace Tests\Feature\Http\Controllers\Api\File;

use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use Tests\AuthAttach;
use Illuminate\Support\Facades\Storage;

class ApiFileControllerUploadImageTest extends TestCase
{
    use AuthAttach;

    private static $uri = 'api/files/upload-image';


    /**
     * Гость не имеет права на аплоад
     * @group fileUpload
     */
    public function testDenied401()
    {
        $data = [
            'image' => UploadedFile::fake()->image('тестовый_файл.jpg'),
        ];

        $response = $this->json('post', self::$uri, $data);

        $response->assertStatus(401)
            ->assertJson(['success' => false]);
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

        $response = $this->tokenHeader()->json('post', self::$uri, $data);

        $response
            ->assertStatus(422)
            ->assertJson(['success' => false])
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

        $response = $this->tokenHeader()->json('post', self::$uri, $data);

        $response
            ->assertStatus(422)
            ->assertJson(['success' => false])
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

        $response = $this->tokenHeader()->json('post', self::$uri, $data);

        $response
            ->assertStatus(422)
            ->assertJson(['success' => false])
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

        $response = $this->tokenHeader()->json('post', self::$uri, $data);

        $response->assertStatus(200)
            ->assertJsonStructure(['fileData'])
            ->assertJson(['success' => true]);

        $result = json_decode($response->getContent(), true);

        $fileData = $result['fileData'];

        Storage::disk($fileData['disk'])->assertExists($fileData['path']);
    }


}