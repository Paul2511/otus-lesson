<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Tests\Feature;

class PromotionGenerator {
    
    public static function generatePromotion(array $data = []){
        return self::generate(array_merge([
            'title'=> 'Title',
            'text' => 'Testing text',
            'validate' => '2021-05-31 23:59:59',
            'status' => 0,            
        ], $data));
    }


    private static function generate(array $data){
        return \App\Models\Promotion::factory()->create($data);
    }
}
