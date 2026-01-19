@extends('dashboard.layouts.master')

@section('title', 'Subscribers')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Subscribers</h5>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Email</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Subscribed At</th>
                            <th>Unsubscribed At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($subscribers as $subscriber)
                            <tr>
                                <td>{{ $subscriber->id }}</td>
                                <td>
                                    <a href="mailto:{{ $subscriber->email }}">{{ $subscriber->email }}</a>
                                </td>
                                <td>{{ $subscriber->name ?? 'N/A' }}</td>
                                <td>
                                    @if($subscriber->is_active)
                                        <span class="badge bg-label-success">Active</span>
                                    @else
                                        <span class="badge bg-label-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>{{ $subscriber->subscribed_at->format('Y-m-d H:i') }}</td>
                                <td>
                                    @if($subscriber->unsubscribed_at)
                                        {{ $subscriber->unsubscribed_at->format('Y-m-d H:i') }}
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <form action="{{ route('admin.subscribers.toggle-status', $subscriber->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PATCH')
                                            @if($subscriber->is_active)
                                                <button type="submit" class="btn btn-sm btn-label-warning" title="Deactivate">
                                                    <i class="ti ti-ban"></i>
                                                </button>
                                            @else
                                                <button type="submit" class="btn btn-sm btn-label-success" title="Activate">
                                                    <i class="ti ti-check"></i>
                                                </button>
                                            @endif
                                        </form>
                                        <form action="{{ route('admin.subscribers.destroy', $subscriber->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this subscriber?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-label-danger">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No subscribers found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $subscribers->links() }}
            </div>
        </div>
    </div>
@endsection
