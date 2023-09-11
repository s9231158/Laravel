<!DOCTYPE html>
<html>
<head>
    <title>郵件驗證</title>
</head>
<body>
    <h2>請點擊以下鏈接進行郵件驗證：</h2>
    <a href="{{ route('verify.email', $user->verification_token) }}">驗證郵件</a>
</body>
</html>
