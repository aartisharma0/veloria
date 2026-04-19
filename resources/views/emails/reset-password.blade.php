<x-mail::message>
# Reset Your Password

You requested a password reset for your Veloria account.

Click the button below to set a new password. This link expires in 60 minutes.

<x-mail::button :url="url('/reset-password/' . $token . '?email=' . urlencode($email))">
Reset Password
</x-mail::button>

If you didn't request this, please ignore this email. Your password will remain unchanged.

Thanks,<br>
Team Veloria
</x-mail::message>
