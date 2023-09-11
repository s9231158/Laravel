<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;

use App\Listeners\SendVerificationEmail;
use App\Mail\SendVerificationEmail as SendVerificationEmailMail;
use Database\Factories\UserFactory; // 確保您有引入工廠類的命名空間

class SendVerificationEmailTest extends TestCase
{
    use RefreshDatabase;

    public function test_send_verification_email()
    {
        Mail::fake(); // 使用 Mail::fake() 來模擬郵件的發送

        // 創建一個用戶實例，可以使用測試用的數據
        $user = UserFactory::new()->create([
            'email' => 'test@example.com', // 替換成實際的測試郵件地址
        ]);

        // 創建事件實例，並將用戶對象作為參數
        $event = new Registered($user);

        // 創建事件處理程序實例
        $listener = new SendVerificationEmail();

        // 調用事件處理程序的 handle 方法，傳入事件實例
        $listener->handle($event);

        // 斷言是否發送了指定的郵件
        Mail::assertSent(SendVerificationEmailMail::class, 1);
    }
}
