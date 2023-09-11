<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;
use APP\Livewire\ShopPage; // 根據您的應用程序路徑調整

class ShopPageTest extends TestCase
{
    /**
     * A basic feature test example.
     */ public function testBuyButtonAddsToCart()
    {
        $user = User::find(5);
        dump($user);
        // 確保用戶對象存在並實現了 Authenticatable 接口
        if ($user) {
            // 使用已存在的用戶ID創建 Livewire 組件實例
            Livewire::actingAs($user)
                ->test(ShopPage::class)
                ->call('addCart', 1); // 假設商品ID為1

            // 在這裡添加斷言，檢查購物車是否已更新，或者其他您希望測試的事項
        } else {
            $this->fail('用戶對象無效。');
        }
    }
}