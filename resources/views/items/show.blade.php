@extends('layouts.app')

@section('title', 'View Item')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-box me-2"></i>
                    Item Details
                </h5>
                <div class="btn-group">
                    <a href="{{ route('items.edit', $item) }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-edit me-1"></i>
                        Edit
                    </a>
                    <form action="{{ route('items.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">
                            <i class="fas fa-trash me-1"></i>
                            Delete
                        </button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-muted">Item Information</h6>
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>ID:</strong></td>
                                <td>{{ $item->id }}</td>
                            </tr>
                            <tr>
                                <td><strong>Name:</strong></td>
                                <td>{{ $item->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Price:</strong></td>
                                <td class="text-success fs-5"><strong>Rp {{ number_format($item->price, 0, ',', '.') }}</strong></td>
                            </tr>
                            <tr>
                                <td><strong>Barcode:</strong></td>
                                <td>{{ $item->barcode ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Stock:</strong></td>
                                <td>
                                    <span class="badge {{ $item->stock_quantity > 10 ? 'bg-success' : ($item->stock_quantity > 0 ? 'bg-warning' : 'bg-danger') }} fs-6">
                                        {{ $item->stock_quantity }} units
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Status:</strong></td>
                                <td>
                                    <span class="badge {{ $item->is_active ? 'bg-success' : 'bg-secondary' }} fs-6">
                                        {{ $item->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Description</h6>
                        <p class="mb-3">{{ $item->description ?? 'No description available.' }}</p>
                        
                        <h6 class="text-muted">Timestamps</h6>
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Created:</strong></td>
                                <td>{{ $item->created_at->format('M d, Y H:i:s') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Updated:</strong></td>
                                <td>{{ $item->updated_at->format('M d, Y H:i:s') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <div class="mt-4">
                    <a href="{{ route('items.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>
                        Back to Items
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
