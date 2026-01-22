@extends('dashboard.layouts.master')

@section('title', 'Counters')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Counters</h5>
            <a href="{{ route('admin.counters.create') }}" class="btn btn-primary">
                <i class="ti ti-plus me-1"></i>
                Add Counter
            </a>
        </div>
        <div class="card-body">
            @if (session('success'))
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
                            <th>Title (Number)</th>
                            <th>Subtitle (Label)</th>
                            <th>Value</th>
                            <th>Suffix</th>
                            <th>Status</th>
                            <th>Order</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($counters as $index => $counter)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $counter->title }}</td>
                                <td>{{ $counter->subtitle }}</td>
                                <td>{{ $counter->value }}</td>
                                <td>{{ $counter->suffix }}</td>
                                <td>
                                    @if ($counter->status === 'active')
                                        <span class="badge bg-label-success">Active</span>
                                    @else
                                        <span class="badge bg-label-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td>{{ $counter->sort_order }}</td>
                                <td>
                                    <a href="{{ route('admin.counters.edit', $counter->id) }}"
                                        class="btn btn-sm btn-label-primary">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.counters.destroy', $counter->id) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this counter?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-label-danger">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No counters found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

