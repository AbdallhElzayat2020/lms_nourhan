@extends('dashboard.layouts.master')

@section('title', 'Partner Details')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Partner Details</h5>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.partners.edit', $partner->id) }}" class="btn btn-label-primary">
                    <i class="ti ti-edit me-1"></i>
                    Edit
                </a>
                <a href="{{ route('admin.partners.index', request()->query()) }}" class="btn btn-label-secondary">
                    <i class="ti ti-arrow-left me-1"></i>
                    Back
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="text-center mb-4">
                        @if($partner->logo)
                            <img src="{{ asset('uploads/partners/' . $partner->logo) }}" alt="{{ $partner->name }}"
                                class="img-fluid" style="max-width: 300px; max-height: 300px; object-fit: contain; border-radius: 8px; background: #f5f5f5; padding: 20px;">
                        @else
                            <div class="bg-light p-5 rounded">
                                <i class="ti ti-image-off" style="font-size: 48px; color: #ccc;"></i>
                                <p class="text-muted mt-2">No Logo</p>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-8">
                    <table class="table table-bordered">
                        <tr>
                            <th width="200">ID</th>
                            <td>{{ $partner->id }}</td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td><strong>{{ $partner->name }}</strong></td>
                        </tr>
                        <tr>
                            <th>Website Link</th>
                            <td>
                                @if($partner->link)
                                    <a href="{{ $partner->link }}" target="_blank" class="text-primary">
                                        <i class="ti ti-external-link me-1"></i>
                                        {{ $partner->link }}
                                    </a>
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($partner->status == 'active')
                                    <span class="badge bg-label-success">Active</span>
                                @else
                                    <span class="badge bg-label-danger">Inactive</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Sort Order</th>
                            <td>{{ $partner->sort_order }}</td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{ $partner->created_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                        <tr>
                            <th>Updated At</th>
                            <td>{{ $partner->updated_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
