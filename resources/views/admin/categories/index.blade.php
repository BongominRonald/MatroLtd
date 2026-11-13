@extends('admin.layouts.admin')

@section('title', 'Categories — BRX Agro Global Administration')
@section('page-title', 'Commodity Categories')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <p class="text-muted small mb-0">Organize and manage commodity segments for agricultural export and domestic sales.</p>
    </div>
</div>

<div class="row g-4">
    <!-- Category List Table -->
    <div class="col-lg-8">
        <div class="card admin-card">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0">Existing Segments</h6>
                <span class="badge bg-light text-dark border">{{ $categories->count() }} categories</span>
            </div>
            <div class="table-responsive">
                <table class="table admin-table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Slug</th>
                            <th>Products</th>
                            <th>Description</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="p-2 bg-light rounded text-success border">
                                            <i class="bi {{ $category->icon ?? 'bi-tag' }}"></i>
                                        </div>
                                        <div class="fw-bold text-dark">{{ $category->name }}</div>
                                    </div>
                                </td>
                                <td>
                                    <code class="small text-secondary">{{ $category->slug }}</code>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border">
                                        {{ $category->products_count }} item(s)
                                    </span>
                                </td>
                                <td>
                                    <small class="text-muted text-truncate d-block" style="max-width: 200px;">
                                        {{ $category->description ?? '—' }}
                                    </small>
                                </td>
                                <td class="text-end">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editCatModal{{ $category->id }}" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete category ' + {{ json_encode($category->name) }} + '?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete" {{ $category->products_count > 0 ? 'disabled' : '' }}>
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>

                                    <!-- Edit Modal -->
                                    <div class="modal fade text-start" id="editCatModal{{ $category->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <form action="{{ route('admin.categories.update', $category) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title fw-bold">Edit Category: {{ $category->name }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body p-4">
                                                        <div class="mb-3">
                                                            <label class="form-label small fw-bold">Name</label>
                                                            <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label small fw-bold">Bootstrap Icon Class</label>
                                                            <input type="text" name="icon" class="form-control" value="{{ $category->icon }}" placeholder="e.g. bi-flower1">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label small fw-bold">Description</label>
                                                            <textarea name="description" class="form-control" rows="3">{{ $category->description }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-matro">Save Changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">No categories created yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Category Form -->
    <div class="col-lg-4">
        <div class="card admin-card p-4">
            <h5 class="fw-bold mb-3">Add New Category</h5>
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label small fw-bold">Category Name *</label>
                    <input type="text" name="name" class="form-control" placeholder="e.g. Spices &amp; Seasonings" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">Bootstrap Icon (optional)</label>
                    <input type="text" name="icon" class="form-control" placeholder="e.g. bi-brightness-high">
                    <small class="text-muted">Use icons from <a href="https://icons.getbootstrap.com" target="_blank">Bootstrap Icons</a></small>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">Description</label>
                    <textarea name="description" rows="3" class="form-control" placeholder="Summary of products in this category..."></textarea>
                </div>
                <button type="submit" class="btn btn-matro w-100 py-2 shadow-sm">
                    <i class="bi bi-plus-lg me-1"></i>Create Category
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
