
<form action="/" method="POST" id='login_form'>
    <input type="email" name="email" placeholder='email@example.com'>
    <input type="password" name="password" placeholder="*********">
    <input type="hidden" name="class" value="Auth">
    <input type="hidden" name="method" value='login'>
    <div class="error"></div>
    <a href="/index.php/forgot_password">Forgot password?</a>
    <input type="submit">
</form>