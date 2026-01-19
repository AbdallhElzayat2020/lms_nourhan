@extends('dashboard.layouts.master')

@section('title', 'Pricing Plan Details')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Pricing Plan Details</h5>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.pricing-plans.edit', $pricingPlan->id) }}" class="btn btn-label-primary">
                    <i class="ti ti-edit me-1"></i>
                    Edit
                </a>
                <a href="{{ route('admin.pricing-plans.index') }}" class="btn btn-label-secondary">
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
                            <td>{{ $pricingPlan->id }}</td>
                        </tr>
                        <tr>
                            <th>Plan Name</th>
                            <td><strong>{{ $pricingPlan->name }}</strong></td>
                        </tr>
                        <tr>
                            <th>Price</th>
                            <td>${{ number_format($pricingPlan->price, 2) }} <span class="text-muted">{{ $pricingPlan->price_period }}</span></td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{{ $pricingPlan->description ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Features</th>
                            <td>
                                @if($pricingPlan->features && count($pricingPlan->features) > 0)
                                    <ul class="mb-0">
                                        @foreach($pricingPlan->features as $feature)
                                            <li>{{ $feature }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="text-muted">No features added</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Featured</th>
                            <td>
                                @if ($pricingPlan->is_featured)
                                    <span class="badge bg-label-warning">Yes (Highlighted)</span>
                                @else
                                    <span class="badge bg-label-secondary">No</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if ($pricingPlan->status == 'active')
                                    <span class="badge bg-label-success">Active</span>
                                @else
                                    <span class="badge bg-label-danger">Inactive</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Sort Order</th>
                            <td>{{ $pricingPlan->sort_order }}</td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{ $pricingPlan->created_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                        <tr>
                            <th>Updated At</th>
                            <td>{{ $pricingPlan->updated_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
