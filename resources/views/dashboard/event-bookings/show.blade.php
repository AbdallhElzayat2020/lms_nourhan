@extends('dashboard.layouts.master')

@section('title', 'Event Booking Details')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Event Booking Details</h5>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.event-bookings.index') }}" class="btn btn-label-secondary">
                    <i class="ti ti-arrow-left me-1"></i>
                    Back
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <table class="table table-bordered">
                        <tr>
                            <th width="200">ID</th>
                            <td>{{ $eventBooking->id }}</td>
                        </tr>
                        <tr>
                            <th>Event</th>
                            <td>
                                <strong>{{ $eventBooking->event->name }}</strong>
                                <a href="{{ route('admin.events.show', $eventBooking->event->id) }}" class="btn btn-sm btn-label-info ms-2">
                                    <i class="ti ti-eye"></i> View Event
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td><strong>{{ $eventBooking->name }}</strong></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $eventBooking->email }}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{ $eventBooking->phone }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <form action="{{ route('admin.event-bookings.update-status', $eventBooking->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <select name="status" class="form-select d-inline-block" style="width: auto;" onchange="this.form.submit()">
                                        <option value="pending" {{ $eventBooking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="confirmed" {{ $eventBooking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                        <option value="cancelled" {{ $eventBooking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <th>Notes</th>
                            <td>{{ $eventBooking->notes ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{ $eventBooking->created_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                        <tr>
                            <th>Updated At</th>
                            <td>{{ $eventBooking->updated_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
