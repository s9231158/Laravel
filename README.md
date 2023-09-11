利用event搭配Listener用mail把$token = Str::random(60);的值跟視圖一起傳送給註冊email
![註冊](https://github.com/s9231158/Laravel/assets/121070963/6fc014d3-3630-45cc-958f-c9c120ef3590)

點擊確認郵件後使用Eloquent的查詢是否有該亂數
![收信](https://github.com/s9231158/Laravel/assets/121070963/e6a5e6d4-7ef0-4efb-975d-e5ae358ba771)

登入使用Auth::attempt()是否有該信箱與密碼,如果沒登入想進到home主頁會被middleware(['auth.user'])踢回到登入頁
![登入](https://github.com/s9231158/Laravel/assets/121070963/c1aa7831-525e-4de6-a49b-4d0d5fedc263)

使用Socialite根據電子郵件地址查找現有用戶,如果用戶不存在，則創建新用戶
![git登入](https://github.com/s9231158/Laravel/assets/121070963/d4c4a80a-1dc6-440a-bbf6-77303c808cb1)

使用Eloquent將資料庫內商品資訊顯示到視圖,按加入到購物車時將資料存至session
![購物車](https://github.com/s9231158/Laravel/assets/121070963/aab4defb-30d2-43ba-bdc3-4c91d2ab21f4)

當調整購物車內商品數量時使用ajax來更新畫面&session
![購買](https://github.com/s9231158/Laravel/assets/121070963/8db54912-cead-43b3-a9d0-e768927c207d)

結帳時使用PayPal,將session內商品資訊總金額傳給payapl成功跳轉至付款頁面,失敗則取消
![paypal](https://github.com/s9231158/Laravel/assets/121070963/9ac5e797-74ee-4faa-80c8-44cd4f0f9017)


![結帳](https://github.com/s9231158/Laravel/assets/121070963/bb6c2a4a-97e3-484e-ba38-b94935b5f0c6)
