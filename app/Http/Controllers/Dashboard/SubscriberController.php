<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscribers = Subscriber::orderBy('created_at', 'desc')->paginate(15);

        return view('dashboard.subscribers.index', compact('subscribers'));
    }

    /**
     * Toggle subscriber active status.
     */
    public function toggleStatus(Subscriber $subscriber)
    {
        $newStatus = !$subscriber->is_active;

        $subscriber->update([
            'is_active' => $newStatus,
            'unsubscribed_at' => $newStatus ? null : now(),
        ]);

        $status = $newStatus ? 'activated' : 'deactivated';

        return redirect()->back()->with('success', "Subscriber {$status} successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscriber $subscriber)
    {
        $subscriber->delete();

        return redirect()->route('admin.subscribers.index')
            ->with('success', 'Subscriber deleted successfully');
    }
}
