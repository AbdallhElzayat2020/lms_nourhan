<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::with(['category'])
            ->orderBy('is_read')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('dashboard.contacts.index', compact('contacts'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        $contact->load(['category']);

        // Mark as read if not already read
        if (!$contact->is_read) {
            $contact->markAsRead();
        }

        return view('dashboard.contacts.show', compact('contact'));
    }

    /**
     * Mark contact as read.
     */
    public function markAsRead(string $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->markAsRead();

        return redirect()->back()->with('success', 'Contact marked as read');
    }

    /**
     * Mark contact as unread.
     */
    public function markAsUnread(string $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update([
            'is_read' => false,
            'read_at' => null,
        ]);

        return redirect()->back()->with('success', 'Contact marked as unread');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Contact $contact)
    {
        $contact->delete();

        $queryParams = [];
        if ($request->filled('index_query')) {
            parse_str($request->input('index_query'), $queryParams);
        }
        if (empty($queryParams) && $request->header('referer')) {
            $q = parse_url($request->header('referer'), PHP_URL_QUERY);
            if ($q) {
                parse_str($q, $queryParams);
            }
        }

        return redirect()->route('admin.contacts.index', $queryParams)
            ->with('success', 'Contact deleted successfully');
    }
}
