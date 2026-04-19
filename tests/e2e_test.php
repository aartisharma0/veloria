<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Login as admin
$admin = App\Models\User::where('email', 'admin@veloria.com')->first();
auth()->login($admin);

$pass = 0;
$fail = 0;
$errors = [];

function testUrl(string $url, int $expect = 200): array {
    try {
        $request = Illuminate\Http\Request::create($url, 'GET');
        $request->setUserResolver(fn() => auth()->user());

        $response = app()->handle($request);
        $code = $response->getStatusCode();

        if ($code === $expect) {
            return ['pass' => true, 'code' => $code];
        }
        return ['pass' => false, 'code' => $code, 'error' => "Expected $expect"];
    } catch (Throwable $e) {
        return ['pass' => false, 'code' => 0, 'error' => class_basename($e) . ': ' . substr($e->getMessage(), 0, 80)];
    }
}

// Admin pages
$adminPages = [
    '/admin/dashboard',
    '/admin/categories',
    '/admin/categories/create',
    '/admin/products',
    '/admin/products/create',
    '/admin/orders',
    '/admin/customers',
    '/admin/coupons',
    '/admin/coupons/create',
    '/admin/reviews',
    '/admin/subscribers',
    '/admin/enquiries',
    '/admin/settings',
];

// Add edit pages
$cat = App\Models\Category::first();
if ($cat) $adminPages[] = "/admin/categories/{$cat->id}/edit";

$prod = App\Models\Product::first();
if ($prod) $adminPages[] = "/admin/products/{$prod->id}/edit";

$order = App\Models\Order::first();
if ($order) $adminPages[] = "/admin/orders/{$order->id}";

$coupon = App\Models\Coupon::first();
if ($coupon) $adminPages[] = "/admin/coupons/{$coupon->id}/edit";

$enquiry = App\Models\Enquiry::first();
if ($enquiry) $adminPages[] = "/admin/enquiries/{$enquiry->id}";

echo "ADMIN PAGES (logged in as admin)\n";
echo "-------------------------------------------\n";
foreach ($adminPages as $url) {
    $result = testUrl($url);
    if ($result['pass']) {
        echo "  PASS  $url  ({$result['code']})\n";
        $pass++;
    } else {
        echo "  FAIL  $url  ({$result['code']}) - {$result['error']}\n";
        $fail++;
        $errors[] = $url;
    }
}

// User pages (as admin - admin can access user pages too)
echo "\nUSER PAGES (logged in)\n";
echo "-------------------------------------------\n";
$userPages = [
    '/wishlist',
    '/account/profile',
    '/account/orders',
    '/account/addresses',
];

if ($order) $userPages[] = "/account/orders/{$order->id}";
if ($order) $userPages[] = "/invoice/{$order->id}";

foreach ($userPages as $url) {
    $result = testUrl($url);
    if ($result['pass']) {
        echo "  PASS  $url  ({$result['code']})\n";
        $pass++;
    } else {
        echo "  FAIL  $url  ({$result['code']}) - {$result['error']}\n";
        $fail++;
        $errors[] = $url;
    }
}

// Public pages
echo "\nPUBLIC PAGES\n";
echo "-------------------------------------------\n";
$publicPages = [
    '/', '/shop', '/cart', '/login', '/register',
    '/contact', '/shipping-delivery', '/returns-exchanges', '/size-guide', '/faqs',
    '/shop?category=women', '/shop?category=men', '/shop?q=dress', '/shop?sort=price_low',
];

$product = App\Models\Product::where('status', 'active')->first();
if ($product) $publicPages[] = "/product/{$product->slug}";

foreach ($publicPages as $url) {
    $result = testUrl($url);
    if ($result['pass']) {
        echo "  PASS  $url  ({$result['code']})\n";
        $pass++;
    } else {
        echo "  FAIL  $url  ({$result['code']}) - {$result['error']}\n";
        $fail++;
        $errors[] = $url;
    }
}

// 404 test
echo "\n404 TEST\n";
echo "-------------------------------------------\n";
$result = testUrl('/product/non-existent-product-xyz', 404);
if ($result['pass']) {
    echo "  PASS  /product/invalid  (404)\n";
    $pass++;
} else {
    echo "  FAIL  /product/invalid  ({$result['code']})\n";
    $fail++;
}

echo "\n===========================================\n";
echo "TOTAL: $pass passed, $fail failed\n";
if ($fail > 0) {
    echo "FAILED PAGES:\n";
    foreach ($errors as $e) echo "  - $e\n";
}
echo "===========================================\n";
