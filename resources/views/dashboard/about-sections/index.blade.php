@extends('dashboard.layouts.master')

@section('title', 'About Section')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">About Section</h5>
            <a href="{{ route('admin.about-sections.edit', $aboutSection->id) }}" class="btn btn-primary">
                <i class="ti ti-edit me-1"></i>
                Edit Section
            </a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-md-6">
                    <h6 class="text-muted mb-3">Section Information</h6>
                    <table class="table table-bordered">
                        <tr>
                            <th width="150">Subtitle:</th>
                            <td>{{ $aboutSection->subtitle ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Title:</th>
                            <td>{{ $aboutSection->title }}</td>
                        </tr>
                        <tr>
                            <th>Description:</th>
                            <td>{{ $aboutSection->description ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Button Text:</th>
                            <td>{{ $aboutSection->button_text ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Button Link:</th>
                            <td>
                                @if($aboutSection->button_link)
                                    <a href="{{ $aboutSection->button_link }}" target="_blank">{{ $aboutSection->button_link }}</a>
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Video URL:</th>
                            <td>
                                @if($aboutSection->video_url)
                                    <a href="{{ $aboutSection->video_url }}" target="_blank">{{ Str::limit($aboutSection->video_url, 50) }}</a>
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Status:</th>
                            <td>
                                @if($aboutSection->status == 'active')
                                    <span class="badge bg-label-success">Active</span>
                                @else
                                    <span class="badge bg-label-danger">Inactive</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h6 class="text-muted mb-3">Preview</h6>
                    @if($aboutSection->video_url)
                        <div class="border rounded p-3 bg-light">
                            <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; background: #000;">
                                <iframe style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;"
                                    src="{{ $aboutSection->video_url }}"
                                    title="Video preview"
                                    allowfullscreen>
                                </iframe>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-info">No video URL set</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
