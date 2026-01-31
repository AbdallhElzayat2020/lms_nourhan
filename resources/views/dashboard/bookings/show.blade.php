@extends('dashboard.layouts.master')

@section('title', 'Booking Details')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Booking Details</h5>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.bookings.index', request()->query()) }}" class="btn btn-label-secondary">
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
                            <td>{{ $booking->id }}</td>
                        </tr>
                        <tr>
                            <th>Full Name</th>
                            <td><strong>{{ $booking->fullname }}</strong></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $booking->email }}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{ $booking->phone }}</td>
                        </tr>
                        <tr>
                            <th>Country</th>
                            <td>{{ $booking->country_name ?? ($booking->country ?? 'N/A') }}</td>
                        </tr>
                        <tr>
                            <th>Time Zone</th>
                            <td>{{ $booking->timezone ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" class="form-select d-inline-block" style="width: auto;" onchange="this.form.submit()">
                                        <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                        <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <th>Notes</th>
                            <td>{{ $booking->notes ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{ $booking->created_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                        <tr>
                            <th>Updated At</th>
                            <td>{{ $booking->updated_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
