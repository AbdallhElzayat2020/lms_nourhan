@extends('dashboard.layouts.master')

@section('title', 'About Info (History / Mission / Vision)')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">About Info (History / Mission / Vision)</h5>
            {{-- <a href="{{ route('admin.about-infos.create') }}" class="btn btn-primary">
                <i class="ti ti-plus me-1"></i>
                Add Item
            </a> --}}
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
                            <th>Title</th>
                            <th>Slug</th>
                            <th>Icon Class</th>
                            <th>Status</th>
                            <th>Order</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($aboutInfos as $info)
                            <tr>
                                <td>{{ $info->id }}</td>
                                <td>{{ $info->title }}</td>
                                <td><code>{{ $info->slug }}</code></td>
                                <td>{{ $info->icon_class }}</td>
                                <td>
                                    @if ($info->status === 'active')
                                        <span class="badge bg-label-success">Active</span>
                                    @else
                                        <span class="badge bg-label-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td>{{ $info->sort_order }}</td>
                                <td>
                                    <a href="{{ route('admin.about-infos.edit', $info->id) }}"
                                        class="btn btn-sm btn-label-primary">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.about-infos.destroy', $info->id) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this item?');">
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
                                <td colspan="7" class="text-center">No items found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

