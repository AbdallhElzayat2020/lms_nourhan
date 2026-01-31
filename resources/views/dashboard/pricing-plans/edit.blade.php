@extends('dashboard.layouts.master')

@section('title', 'Edit Pricing Plan')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Edit Pricing Plan</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.pricing-plans.update', $pricingPlan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Plan Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                               name="name" value="{{ old('name', $pricingPlan->name) }}" required>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="price" class="form-label">Price <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price"
                               name="price" value="{{ old('price', $pricingPlan->price) }}" required>
                        @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="price_period" class="form-label">Price Period</label>
                        <input type="text" class="form-control @error('price_period') is-invalid @enderror" id="price_period"
                               name="price_period" value="{{ old('price_period', $pricingPlan->price_period) }}">
                        <small class="text-muted">e.g. /Per month, /Per year</small>
                        @error('price_period')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                              name="description" rows="2">{{ old('description', $pricingPlan->description) }}</textarea>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Features</label>
                    <div id="features-container">
                        @if(old('features'))
                            @foreach(old('features') as $feature)
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" name="features[]" value="{{ $feature }}">
                                    <button type="button" class="btn btn-outline-danger remove-feature">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </div>
                            @endforeach
                        @elseif($pricingPlan->features && count($pricingPlan->features) > 0)
                            @foreach($pricingPlan->features as $feature)
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" name="features[]" value="{{ $feature }}">
                                    <button type="button" class="btn btn-outline-danger remove-feature">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </div>
                            @endforeach
                        @else
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="features[]" placeholder="Feature 1">
                                <button type="button" class="btn btn-outline-danger remove-feature" style="display: none;">
                                    <i class="ti ti-trash"></i>
                                </button>
                            </div>
                        @endif
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-primary" id="add-feature">
                        <i class="ti ti-plus me-1"></i>Add Feature
                    </button>
                    <small class="text-muted d-block mt-1">Add features for this plan</small>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="active" {{ old('status', $pricingPlan->status) == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $pricingPlan->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="sort_order" class="form-label">Sort Order</label>
                        <input type="number" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order"
                               name="sort_order" value="{{ old('sort_order', $pricingPlan->sort_order) }}" min="0">
                        @error('sort_order')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="form-check mt-4">
                            <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1"
                                   {{ old('is_featured', $pricingPlan->is_featured) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_featured">
                                Featured Plan (Highlighted)
                            </label>
                        </div>
                    </div>
                </div>

                @include('dashboard.components.seo-fields', [
                    'item' => $pricingPlan,
                    'itemType' => 'pricing plan',
                    'fallbackField' => 'name',
                    'schemaPlaceholder' => '{&quot;@@context&quot;: &quot;https://schema.org&quot;, &quot;@type&quot;: &quot;Offer&quot;, &quot;name&quot;: &quot;Plan Name&quot;, &quot;price&quot;: &quot;0&quot;, &quot;priceCurrency&quot;: &quot;USD&quot;}'
                ])

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-check me-1"></i>
                        Update Plan
                    </button>
                    <a href="{{ route('admin.pricing-plans.index', request()->query()) }}" class="btn btn-label-secondary">
                        <i class="ti ti-x me-1"></i>
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    @push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('features-container');
            const addBtn = document.getElementById('add-feature');

            addBtn.addEventListener('click', function() {
                const div = document.createElement('div');
                div.className = 'input-group mb-2';
                div.innerHTML = `
                    <input type="text" class="form-control" name="features[]" placeholder="Feature">
                    <button type="button" class="btn btn-outline-danger remove-feature">
                        <i class="ti ti-trash"></i>
                    </button>
                `;
                container.appendChild(div);
                updateRemoveButtons();
            });

            container.addEventListener('click', function(e) {
                if (e.target.closest('.remove-feature')) {
                    e.target.closest('.input-group').remove();
                    updateRemoveButtons();
                }
            });

            function updateRemoveButtons() {
                const groups = container.querySelectorAll('.input-group');
                groups.forEach((group, index) => {
                    const removeBtn = group.querySelector('.remove-feature');
                    if (groups.length > 1) {
                        removeBtn.style.display = 'block';
                    } else {
                        removeBtn.style.display = 'none';
                    }
                });
            }

            updateRemoveButtons();
        });
    </script>
    @endpush
@endsection
