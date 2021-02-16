<?php

namespace App\Services\Promotions\Repositories;

use App\Models\Promotion;
use App\Http\Controllers\Admin\AdminBaseController;
use \Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EloquentPromotionsRepository {
    
    /** 
     * 
     * @return \App\Services\Promotions\Repositories\LengthAwarePaginator
     */
    
    public function getList(int $id):Collection {
        return Promotion::where('id', $id)->get();
    }
    
    public function getPromotion(int $id):Promotion
    {
        return Promotion::where('id', $id)->first();
    }
    
    public function createFromArray(array $data): Promotion
    {
        return Promotion::create($data);
    }
    
    public function updateFromArray(array $data): Promotion
    {
        return Promotion::update($data);
    }
    
    private function getUsersFromPromotionsLink(int $category_id){
        return DB::table('promotions_link')->select('user_id')->where('category_id', $category_id)->get();
    }
    
    private function getUsersEmail(int $category_id){
        return User::select('email')->whereIn('id', $this->getUsersFromPromotionsLink($category_id))->get();
    }
    
    public function sendEmail(array $data){
        $emails = $this->getUsersEmail($data['category_id']);
        foreach($emails as $email){
            Mail::to($email)->send(new \App\Mail\Promotions($data));
        }
    }
}
