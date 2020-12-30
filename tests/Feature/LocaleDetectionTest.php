<?php

namespace Tests\Feature;

use Tests\TestCase;

class LocaleDetectionTest extends TestCase
{
    /**
     * Поддержка русской локали
     * @group locale
     */
    public function testLocaleRu()
    {
        $payload = ['email' => 'wrong-email'];

        $response = $this->withHeaders([
            'Accept-Language'=>'ru'
        ])->json('POST', 'api/auth/login', $payload);

        $response->assertStatus(422)
            ->assertJson(['success' => false])
            ->assertJsonValidationErrors(['password'])
            ->assertJsonPath('message', trans('form.validationErrorMessage', [], 'ru'));
    }

    /**
     * Поддержка английской локали
     * @group locale
     */
    public function testLocaleEn()
    {
        $payload = ['email' => 'wrong-email'];

        $response = $this->withHeaders([
            'Accept-Language'=>'en'
        ])->json('POST', 'api/auth/login', $payload);

        $response->assertStatus(422)
            ->assertJson(['success' => false])
            ->assertJsonValidationErrors(['password'])
            ->assertJsonPath('message', trans('form.validationErrorMessage', [], 'en'));
    }

    /**
     * Локаль не поддерживается
     * @group locale
     */
    public function testLocaleNotSupportInRussian()
    {
        $payload = ['email' => 'wrong-email'];

        $response = $this->withHeaders([
            'Accept-Language'=>'fr'
        ])->json('POST', 'api/auth/login', $payload);

        $response->assertStatus(422)
            ->assertJson(['success' => false])
            ->assertJsonValidationErrors(['password'])
            ->assertJsonPath('message', trans('form.validationErrorMessage', [], 'ru'));
    }
}
