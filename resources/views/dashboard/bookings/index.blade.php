@extends('dashboard.layouts.master')

@section('title', 'Bookings')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Course Bookings</h5>
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Country</th>
                            <th>Time Zone</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $booking)
                            <tr>
                                <td>{{ $booking->id }}</td>
                                <td><strong>{{ $booking->fullname }}</strong></td>
                                <td>{{ $booking->email }}</td>
                                <td>{{ $booking->phone }}</td>
                                <td>{{ $booking->country_name ?? ($booking->country ?? 'N/A') }}</td>
                                <td>{{ $booking->timezone ?? 'N/A' }}</td>
                                <td>
                                    @if($booking->status == 'pending')
                                        <span class="badge bg-label-warning">Pending</span>
                                    @elseif($booking->status == 'confirmed')
                                        <span class="badge bg-label-success">Confirmed</span>
                                    @else
                                        <span class="badge bg-label-danger">Cancelled</span>
                                    @endif
                                </td>
                                <td>{{ $booking->created_at->format('Y-m-d H:i') }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.bookings.show', $booking->id) }}"
                                            class="btn btn-sm btn-label-primary">
                                            <i class="ti ti-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this booking?');">
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
                                <td colspan="9" class="text-center">No bookings found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $bookings->links() }}
            </div>
        </div>
    </div>
@endsection
