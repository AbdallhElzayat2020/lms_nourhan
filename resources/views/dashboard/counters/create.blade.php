@extends('dashboard.layouts.master')

@section('title', 'Add Counter')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Add Counter</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.counters.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Title (number with suffix)</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', '3,192+') }}"
                            placeholder="e.g. 3,192+">
                        @error('title')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Subtitle (label)</label>
                        <input type="text" name="subtitle" class="form-control"
                            value="{{ old('subtitle', 'Successfully Trained') }}" placeholder="e.g. Successfully Trained">
                        @error('subtitle')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Value (for animation)</label>
                        <input type="text" name="value" class="form-control" value="{{ old('value', '3192') }}"
                            placeholder="e.g. 3192">
                        @error('value')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Suffix</label>
                        <input type="text" name="suffix" class="form-control" value="{{ old('suffix', '+') }}"
                            placeholder="e.g. + or %">
                        @error('suffix')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Sort Order</label>
                        <input type="number" name="sort_order" class="form-control"
                            value="{{ old('sort_order', 0) }}">
                        @error('sort_order')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>Active
                            </option>
                            <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive
                            </option>
                        </select>
                        @error('status')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('admin.counters.index', request()->query()) }}" class="btn btn-label-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection

