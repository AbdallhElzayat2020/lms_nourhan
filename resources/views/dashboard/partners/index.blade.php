@extends('dashboard.layouts.master')

@section('title', 'Partners')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Partners</h5>
            <a href="{{ route('admin.partners.create') }}{{ request()->query() ? '?' . http_build_query(request()->query()) : '' }}" class="btn btn-primary">
                <i class="ti ti-plus me-1"></i>
                Add New Partner
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
                            <th>Logo</th>
                            <th>Name</th>
                            <th>Link</th>
                            <th>Status</th>
                            <th>Order</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($partners as $index => $partner)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    @if ($partner->logo)
                                        <img src="{{ asset('uploads/partners/' . $partner->logo) }}"
                                            alt="{{ $partner->name }}"
                                            style="width: 80px; height: 80px; object-fit: contain; border-radius: 8px; background: #f5f5f5; padding: 5px;">
                                    @else
                                        <span class="text-muted">No Logo</span>
                                    @endif
                                </td>
                                <td><strong>{{ $partner->name }}</strong></td>
                                <td>
                                    @if ($partner->link)
                                        <a href="{{ $partner->link }}" target="_blank" class="text-primary">
                                            <i class="ti ti-external-link me-1"></i>
                                            {{ Str::limit($partner->link, 30) }}
                                        </a>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($partner->status == 'active')
                                        <span class="badge bg-label-success">Active</span>
                                    @else
                                        <span class="badge bg-label-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>{{ $partner->sort_order }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.partners.show', $partner->id) }}{{ request()->query() ? '?' . http_build_query(request()->query()) : '' }}"
                                            class="btn btn-sm btn-label-info">
                                            <i class="ti ti-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.partners.edit', $partner->id) }}{{ request()->query() ? '?' . http_build_query(request()->query()) : '' }}"
                                            class="btn btn-sm btn-label-primary">
                                            <i class="ti ti-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.partners.destroy', $partner->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this partner?');">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="index_query" value="{{ http_build_query(request()->query()) }}">
                                            <button type="submit" class="btn btn-sm btn-label-danger">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No partners found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $partners->links() }}
            </div>
        </div>
    </div>
@endsection
