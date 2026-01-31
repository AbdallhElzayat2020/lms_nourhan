@extends('dashboard.layouts.master')

@section('title', 'Teacher Details')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Teacher Details</h5>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.teachers.edit', $teacher->id) }}" class="btn btn-primary">
                    <i class="ti ti-edit me-1"></i>
                    Edit
                </a>
                <a href="{{ route('admin.teachers.index', request()->query()) }}" class="btn btn-label-secondary">
                    Back to List
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    @if($teacher->image)
                        <img src="{{ asset('uploads/teachers/' . $teacher->image) }}" alt="{{ $teacher->name }}"
                            class="img-fluid rounded mb-3" style="max-width: 100%;">
                    @else
                        <div class="bg-light rounded p-5 text-center mb-3">
                            <i class="ti ti-user" style="font-size: 4rem; color: #ccc;"></i>
                            <p class="text-muted mt-2">No Image</p>
                        </div>
                    @endif

                    <table class="table table-bordered">
                        <tr>
                            <th width="120">Status:</th>
                            <td>
                                @if($teacher->status == 'active')
                                    <span class="badge bg-label-success">Active</span>
                                @else
                                    <span class="badge bg-label-danger">Inactive</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Sort Order:</th>
                            <td>{{ $teacher->sort_order }}</td>
                        </tr>
                        <tr>
                            <th>Created:</th>
                            <td>{{ $teacher->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Updated:</th>
                            <td>{{ $teacher->updated_at->format('Y-m-d H:i') }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-8">
                    <h3 class="mb-3">{{ $teacher->name }}</h3>

                    @if($teacher->short_description)
                        <div class="mb-4">
                            <h6 class="text-muted mb-2">Short Description</h6>
                            <p>{{ $teacher->short_description }}</p>
                        </div>
                    @endif

                    @if($teacher->description)
                        <div class="mb-4">
                            <h6 class="text-muted mb-2">Description</h6>
                            <div>{!! $teacher->description !!}</div>
                        </div>
                    @endif

                    @if($teacher->video_url)
                        <div class="mb-4">
                            <h6 class="text-muted mb-2">Video</h6>
                            <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; background: #000; border-radius: 8px;">
                                <iframe style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;"
                                    src="{{ $teacher->video_url }}"
                                    title="Teacher video"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                                </iframe>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
