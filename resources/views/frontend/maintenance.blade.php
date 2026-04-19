<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>We'll Be Right Back - Veloria</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #3a3a3a 0%, #1a1a2e 50%, #d63384 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }
        .container { text-align: center; max-width: 600px; padding: 40px 20px; }
        .icon-wrap {
            width: 120px; height: 120px; border-radius: 50%;
            background: rgba(255,255,255,0.1); margin: 0 auto 30px;
            display: flex; align-items: center; justify-content: center;
            animation: pulse 2s ease-in-out infinite;
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.05); opacity: 0.8; }
        }
        .icon-wrap i { font-size: 3rem; color: #f0a1c7; }
        .brand {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem; font-weight: 700;
            letter-spacing: 5px; color: #f0a1c7;
            margin-bottom: 10px;
        }
        .tagline {
            font-family: 'Playfair Display', serif;
            font-style: italic; opacity: 0.6;
            margin-bottom: 30px; font-size: 1rem;
        }
        h1 { font-family: 'Playfair Display', serif; font-size: 1.8rem; margin-bottom: 15px; }
        p { opacity: 0.8; line-height: 1.7; margin-bottom: 20px; font-size: 0.95rem; }
        .cta-box {
            background: rgba(255,255,255,0.1);
            border-radius: 16px; padding: 30px;
            margin-top: 30px; backdrop-filter: blur(10px);
        }
        .cta-box h3 { font-family: 'Playfair Display', serif; font-size: 1.2rem; margin-bottom: 10px; }
        .btn-pink {
            display: inline-block; background: #d63384; color: white;
            padding: 12px 30px; border-radius: 30px; text-decoration: none;
            font-weight: 600; transition: all 0.3s; border: none; cursor: pointer;
            font-size: 0.95rem;
        }
        .btn-pink:hover { background: #b02a6f; transform: translateY(-2px); box-shadow: 0 5px 20px rgba(214,51,132,0.4); }
        .btn-outline {
            display: inline-block; color: white; border: 2px solid rgba(255,255,255,0.3);
            padding: 10px 25px; border-radius: 30px; text-decoration: none;
            font-weight: 600; transition: all 0.3s; font-size: 0.9rem;
        }
        .btn-outline:hover { border-color: white; background: rgba(255,255,255,0.1); color: white; }
        .social { margin-top: 30px; }
        .social a {
            color: rgba(255,255,255,0.5); font-size: 1.3rem; margin: 0 8px;
            transition: color 0.3s;
        }
        .social a:hover { color: #f0a1c7; }
        .footer { margin-top: 40px; opacity: 0.3; font-size: 0.8rem; }
        .admin-link { position: fixed; bottom: 20px; right: 20px; }
        .admin-link a { color: rgba(255,255,255,0.2); font-size: 0.75rem; text-decoration: none; }
        .admin-link a:hover { color: rgba(255,255,255,0.6); }
    </style>
</head>
<body>
    <div class="container">
        <div class="icon-wrap">
            <i class="bi bi-tools"></i>
        </div>

        <div class="brand">VELORIA</div>
        <div class="tagline">Where every piece tells your story</div>

        <h1>We'll Be Right Back!</h1>
        <p>
            We're currently making some improvements to give you a better shopping experience.
            Please check back shortly — we won't be long!
        </p>

        <div class="cta-box">
            <h3><i class="bi bi-chat-heart me-2"></i>Have a Question?</h3>
            <p style="font-size:0.85rem;">If you need immediate assistance or have an enquiry, you can still reach us.</p>
            <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap;">
                <a href="{{ route('contact') }}" class="btn-pink">
                    <i class="bi bi-envelope me-2"></i>Send Enquiry
                </a>
                <a href="mailto:{{ $settings['store_email'] ?? 'support@veloria.com' }}" class="btn-outline">
                    <i class="bi bi-at me-1"></i>Email Us
                </a>
            </div>
            @if(!empty($settings['store_phone']))
            <p style="margin-top:15px;font-size:0.85rem;">
                <i class="bi bi-telephone me-1"></i> Call: {{ $settings['store_phone'] }}
            </p>
            @endif
        </div>

        <div class="social">
            <a href="#"><i class="bi bi-facebook"></i></a>
            <a href="#"><i class="bi bi-instagram"></i></a>
            <a href="#"><i class="bi bi-twitter-x"></i></a>
            <a href="#"><i class="bi bi-youtube"></i></a>
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} Veloria. All rights reserved.
        </div>
    </div>

    <div class="admin-link">
        <a href="{{ route('login') }}">Admin Login</a>
    </div>
</body>
</html>
