<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function index(Request $request)
    {
        $query = Subscriber::latest();

        if ($request->filled('search')) {
            $query->where('email', 'like', '%' . $request->search . '%');
        }

        $subscribers = $query->paginate(20)->withQueryString();
        $totalCount = Subscriber::count();

        return view('admin.subscribers.index', compact('subscribers', 'totalCount'));
    }

    public function destroy(Subscriber $subscriber)
    {
        $subscriber->delete();
        return back()->with('success', 'Subscriber removed.');
    }

    public function export()
    {
        $subscribers = Subscriber::latest()->get();

        $csv = "Email,Subscribed At\n";
        foreach ($subscribers as $sub) {
            $csv .= "{$sub->email},{$sub->created_at->format('Y-m-d H:i:s')}\n";
        }

        return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="veloria-subscribers-' . date('Y-m-d') . '.csv"');
    }
}
