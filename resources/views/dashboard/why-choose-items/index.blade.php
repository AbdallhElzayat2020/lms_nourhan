@extends('dashboard.layouts.master')

@section('title', 'Why Choose Us')

@section('content')
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Why Choose Us</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Subtitle</th>
                            <th>Icon</th>
                            <th>Video</th>
                            <th>Status</th>
                            <th>Sort</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->subtitle }}</td>
                                <td>
                                    @if ($item->icon_class)
                                        <span class="badge bg-label-secondary">
                                            <i class="{{ $item->icon_class }}"></i>
                                            {{ $item->icon_class }}
                                        </span>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td>
                                    @if($item->video_url)
                                        <span class="badge bg-success">
                                            <i class="ti ti-video me-1"></i> Has Video
                                        </span>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge {{ $item->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                                <td>{{ $item->sort_order }}</td>
                                <td class="d-flex gap-2">
                                    <a href="{{ route('admin.why-choose-items.edit', $item) }}"
                                        class="btn btn-sm btn-warning">
                                        Edit
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">No items yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                <p class="text-muted mb-0">
                    <small><strong>Note:</strong> You can only edit the three items. To change the video, edit any item and add/update the "Video URL" field. The video shown on the homepage will be from the first item that has a video URL.</small>
                </p>
            </div>
        </div>
    </div>
@endsection
