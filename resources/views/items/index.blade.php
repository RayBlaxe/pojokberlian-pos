@extends('layouts.app')

@section('title', 'Item Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>
        <i class="fas fa-box me-2"></i>
        Item Management
    </h2>
    <a href="{{ route('items.create') }}" class="btn btn-gradient">
        <i class="fas fa-plus me-2"></i>
        Add New Item
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if($items->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Barcode</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ Str::limit($item->description, 50) }}</td>
                            <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td>{{ $item->barcode ?? 'N/A' }}</td>
                            <td>
                                <span class="badge {{ $item->stock_quantity > 10 ? 'bg-success' : ($item->stock_quantity > 0 ? 'bg-warning' : 'bg-danger') }}">
                                    {{ $item->stock_quantity }}
                                </span>
                            </td>
                            <td>
                                <span class="badge {{ $item->is_active ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $item->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('items.show', $item) }}" class="btn btn-sm btn-outline-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('items.edit', $item) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('items.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $items->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-box fa-4x text-muted mb-3"></i>
                <h4>No items found</h4>
                <p class="text-muted">Start by adding your first item to the inventory.</p>
                <a href="{{ route('items.create') }}" class="btn btn-gradient">
                    <i class="fas fa-plus me-2"></i>
                    Add First Item
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
