<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý danh mục</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
@include('layouts.header')

<div class="container py-4">
    <div class="mb-3">
        <h1 class="h4 mb-0">Quản lý danh mục</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span class="fw-semibold">Danh sách danh mục</span>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-sm btn-success">Tạo danh mục</a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th style="width:80px">ID</th>
                        <th>Tên</th>
                        <th>Slug</th>
                        <th>Mô tả</th>
                        <th style="width:160px">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td><code>{{ $category->slug }}</code></td>
                            <td class="text-muted">{{ \Illuminate\Support\Str::limit($category->description, 60) }}</td>
                            <td>
                                <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-warning">Sửa</a>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn chắc chắn muốn xoá?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Xoá</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Chưa có danh mục nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $categories->links() }}
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
