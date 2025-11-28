@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="mb-4">
                <h2 class="fw-bold mb-1" style="color: #1a472a;">Nhật ký cần thủ</h2>
                <p class="text-muted mb-0">Chia sẻ những khoảnh khắc đáng nhớ khi câu cá</p>
            </div>

            @guest
            <div class="alert alert-light border shadow-sm mb-4" style="border-radius: 12px; border-left: 4px solid #1a472a !important;">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <p class="mb-0">Đăng nhập để chia sẻ trải nghiệm câu cá của bạn</p>
                    </div>
                    <a href="{{ route('login') }}" class="btn btn-sm fw-semibold" style="background-color: #1a472a; color: white; border-radius: 8px; padding: 8px 20px;">
                        Đăng nhập
                    </a>
                </div>
            </div>
            @endguest

            <div class="row g-3">
                @forelse($logs as $log)
                <div class="col-md-6 col-lg-4">
                    <article class="card h-100 shadow-sm border-0" style="border-radius: 12px; overflow: hidden;">
                        <div class="position-relative" style="background-color: #f8f9fa; cursor: pointer;" onclick="openImageModal('{{ asset($log->image) }}', '{{ addslashes($log->caption) }}', '{{ $log->user->name }}', '{{ $log->created_at->diffForHumans() }}')">
                            <img 
                                src="{{ asset($log->image) }}" 
                                class="w-100" 
                                style="object-fit: cover; height: 280px; display: block;" 
                                alt="Hình ảnh câu cá">
                            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center image-overlay">
                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                    <line x1="11" y1="8" x2="11" y2="14"></line>
                                    <line x1="8" y1="11" x2="14" y2="11"></line>
                                </svg>
                            </div>
                        </div>

                        <div class="card-body p-3">
                            <div class="d-flex align-items-center mb-2">
                                <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" 
                                     style="width: 32px; height: 32px; background: linear-gradient(135deg, #1a472a 0%, #2d6a3f 100%); font-size: 14px; flex-shrink: 0;">
                                    {{ strtoupper(substr($log->user->name, 0, 1)) }}
                                </div>
                                <div class="ms-2 overflow-hidden flex-grow-1">
                                    <h6 class="mb-0 fw-semibold text-truncate" style="font-size: 14px;">{{ $log->user->name }}</h6>
                                    <small class="text-muted" style="font-size: 11px;">{{ $log->created_at->diffForHumans() }}</small>
                                </div>
                                @auth
                                @if($log->user_id === auth()->id())
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-link text-muted p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none;">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="1"></circle>
                                            <circle cx="12" cy="5" r="1"></circle>
                                            <circle cx="12" cy="19" r="1"></circle>
                                        </svg>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" style="border-radius: 8px;">
                                        <li>
                                            <button class="dropdown-item text-danger" onclick="confirmDelete({{ $log->id }})" style="font-size: 14px;">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                </svg>
                                                Xóa bài viết
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                                @endif
                                @endauth
                            </div>

                            <p class="mb-2 text-muted" style="font-size: 13px; line-height: 1.5; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                {{ $log->caption }}
                            </p>

                            @if($log->products->count() > 0)
                            <div class="mt-2">
                                <div class="d-flex flex-wrap gap-1">
                                    @foreach($log->products->take(2) as $taggedProduct)
                                        <a href="{{ route('product.show', $taggedProduct->id) }}" 
                                           class="badge text-decoration-none" 
                                           style="background-color: #f0f0f0; color: #1a472a; padding: 4px 10px; border-radius: 12px; font-weight: 500; font-size: 11px;">
                                            {{ $taggedProduct->name }}
                                        </a>
                                    @endforeach
                                    @if($log->products->count() > 2)
                                        <span class="badge" style="background-color: #f0f0f0; color: #666; padding: 4px 10px; border-radius: 12px; font-size: 11px;">
                                            +{{ $log->products->count() - 2 }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            @endif
                        </div>
                    </article>
                </div>
                @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <div class="mb-3" style="font-size: 48px; opacity: 0.3;">🎣</div>
                        <p class="text-muted">Chưa có bài viết nào</p>
                    </div>
                </div>
                @endforelse
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $logs->links() }}
            </div>
        </div>
    </div>
</div>

@auth
<!-- Floating Action Button -->
<button 
    type="button" 
    class="btn shadow-lg floating-btn" 
    onclick="openPostModal()"
    style="position: fixed; bottom: 30px; right: 30px; width: 60px; height: 60px; border-radius: 50%; background: linear-gradient(135deg, #1a472a 0%, #2d6a3f 100%); color: white; border: none; z-index: 1000; display: flex; align-items: center; justify-content: center; font-size: 24px;">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M12 20h9"></path>
        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
    </svg>
</button>

<!-- Modal for Creating Post -->
<div class="modal fade" id="postModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
            <div class="modal-header border-0 pb-0" style="padding: 24px 24px 16px;">
                <h5 class="modal-title fw-bold" style="color: #1a472a;">Tạo bài viết mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 0 24px 24px;">
                <form action="{{ route('catchlog.store') }}" method="POST" enctype="multipart/form-data" id="postForm">
                    @csrf
                    <div class="mb-3">
                        <textarea 
                            name="caption" 
                            class="form-control border-0 bg-light" 
                            rows="4" 
                            placeholder="Chia sẻ trải nghiệm câu cá của bạn..."
                            style="resize: none; border-radius: 12px; padding: 16px; font-size: 15px;"
                            required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small mb-2" style="color: #1a472a;">Hình ảnh</label>
                        <div class="position-relative">
                            <input 
                                type="file" 
                                name="image" 
                                id="imageInput"
                                class="form-control border" 
                                accept="image/*"
                                style="border-radius: 10px; padding: 12px;"
                                onchange="previewImage(event)"
                                required>
                        </div>
                        <div id="imagePreview" class="mt-3" style="display: none;">
                            <img id="preview" src="" alt="Preview" style="max-width: 100%; max-height: 400px; height: auto; border-radius: 12px; display: block; margin: 0 auto;">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold small mb-2" style="color: #1a472a;">Dụng cụ đã sử dụng</label>
                        <div class="position-relative">
                            <input 
                                type="text" 
                                id="productSearch" 
                                class="form-control border" 
                                placeholder="Tìm kiếm dụng cụ..."
                                style="border-radius: 10px; padding: 12px;"
                                onkeyup="filterProducts()">
                        </div>
                        <div id="productList" class="mt-2 border rounded" style="max-height: 250px; overflow-y: auto; border-radius: 10px; display: none;">
                            @foreach($products as $product)
                            <div class="product-item p-2 border-bottom" style="cursor: pointer; transition: background-color 0.2s;" 
                                 data-product-id="{{ $product->id }}" 
                                 data-product-name="{{ strtolower($product->name) }}"
                                 onclick="toggleProduct({{ $product->id }}, '{{ $product->name }}')">
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" class="form-check-input me-2" id="product_{{ $product->id }}" style="cursor: pointer;">
                                    <label class="form-check-label flex-grow-1" for="product_{{ $product->id }}" style="cursor: pointer; font-size: 14px; color: #000">
                                        {{ $product->name }}
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div id="selectedProducts" class="mt-2 d-flex flex-wrap gap-2"></div>
                        <small class="text-muted d-block mt-1">Tìm kiếm và chọn các dụng cụ bạn đã sử dụng</small>
                    </div>

                    <div class="d-grid gap-2">
                        <button 
                            type="submit" 
                            class="btn fw-semibold" 
                            style="background-color: #1a472a; color: white; border-radius: 10px; padding: 14px;">
                            Đăng bài
                        </button>
                        <button 
                            type="button" 
                            class="btn btn-light" 
                            data-bs-dismiss="modal"
                            style="border-radius: 10px; padding: 12px;">
                            Hủy
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endauth

<!-- Modal for Viewing Image -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content bg-dark border-0" style="border-radius: 16px; overflow: hidden;">
            <div class="modal-body p-0 position-relative">
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close" style="z-index: 10; opacity: 0.9;"></button>
                <div class="text-center" style="background-color: #000;">
                    <img id="modalImage" src="" alt="Full size" style="max-width: 100%; max-height: 85vh; width: auto; height: auto; object-fit: contain;">
                </div>
                <div class="bg-white p-3">
                    <div class="d-flex align-items-center mb-2">
                        <h6 class="fw-semibold mb-0 me-2" id="modalUsername"></h6>
                        <small class="text-muted" id="modalTime"></small>
                    </div>
                    <p class="mb-0 text-muted" id="modalCaption" style="line-height: 1.6;"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Delete Confirmation -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
            <div class="modal-body text-center p-4">
                <div class="mb-3">
                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#dc3545" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="15" y1="9" x2="9" y2="15"></line>
                        <line x1="9" y1="9" x2="15" y2="15"></line>
                    </svg>
                </div>
                <h5 class="fw-bold mb-2">Xóa bài viết?</h5>
                <p class="text-muted mb-4">Bạn có chắc chắn muốn xóa bài viết này? Hành động này không thể hoàn tác.</p>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <div class="d-flex gap-2 justify-content-center">
                        <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal" style="border-radius: 8px;">
                            Hủy
                        </button>
                        <button type="submit" class="btn btn-danger px-4" style="border-radius: 8px;">
                            Xóa bài viết
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.floating-btn {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.floating-btn:hover {
    transform: scale(1.1) rotate(10deg);
    box-shadow: 0 12px 28px rgba(26, 71, 42, 0.4) !important;
}

.floating-btn:active {
    transform: scale(0.95);
}

.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15) !important;
}

.image-overlay {
    opacity: 0;
    background: rgba(0, 0, 0, 0.5);
    transition: opacity 0.3s ease;
}

.card:hover .image-overlay {
    opacity: 1;
}

.badge:hover {
    background-color: #1a472a !important;
    color: white !important;
}

.form-control:focus,
.form-select:focus {
    border-color: #1a472a;
    box-shadow: 0 0 0 0.2rem rgba(26, 71, 42, 0.15);
}

.product-item:hover {
    background-color: #f8f9fa;
}

.product-item.selected {
    background-color: #e8f5e9;
}

.selected-product-badge {
    background-color: #1a472a;
    color: white;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 13px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.selected-product-badge .remove-btn {
    cursor: pointer;
    font-weight: bold;
    opacity: 0.8;
    transition: opacity 0.2s;
}

.selected-product-badge .remove-btn:hover {
    opacity: 1;
}

.modal-content {
    animation: slideUp 0.3s ease-out;
}

.dropdown-toggle::after {
    display: none;
}

.dropdown-menu {
    min-width: 160px;
}

.dropdown-item:hover {
    background-color: #f8f9fa;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<script>
let selectedProductIds = [];

function openPostModal() {
    const modal = new bootstrap.Modal(document.getElementById('postModal'));
    modal.show();
    document.getElementById('productSearch').focus();
}

function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview').src = e.target.result;
            document.getElementById('imagePreview').style.display = 'block';
        }
        reader.readAsDataURL(file);
    }
}

function filterProducts() {
    const searchTerm = document.getElementById('productSearch').value.toLowerCase();
    const productItems = document.querySelectorAll('.product-item');
    const productList = document.getElementById('productList');
    
    if (searchTerm.length > 0) {
        productList.style.display = 'block';
    } else {
        productList.style.display = 'none';
    }
    
    productItems.forEach(item => {
        const productName = item.getAttribute('data-product-name');
        if (productName.includes(searchTerm)) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
}

function toggleProduct(productId, productName) {
    const checkbox = document.getElementById('product_' + productId);
    const productItem = checkbox.closest('.product-item');
    
    if (selectedProductIds.includes(productId)) {
        selectedProductIds = selectedProductIds.filter(id => id !== productId);
        checkbox.checked = false;
        productItem.classList.remove('selected');
    } else {
        selectedProductIds.push(productId);
        checkbox.checked = true;
        productItem.classList.add('selected');
    }
    
    updateSelectedProducts();
}

function updateSelectedProducts() {
    const container = document.getElementById('selectedProducts');
    container.innerHTML = '';
    
    selectedProductIds.forEach(productId => {
        const productItem = document.querySelector(`[data-product-id="${productId}"]`);
        const productName = productItem.querySelector('label').textContent.trim();
        
        const badge = document.createElement('span');
        badge.className = 'selected-product-badge';
        badge.innerHTML = `
            ${productName}
            <span class="remove-btn" onclick="removeProduct(${productId})">×</span>
            <input type="hidden" name="product_ids[]" value="${productId}">
        `;
        container.appendChild(badge);
    });
}

function removeProduct(productId) {
    selectedProductIds = selectedProductIds.filter(id => id !== productId);
    const checkbox = document.getElementById('product_' + productId);
    const productItem = checkbox.closest('.product-item');
    checkbox.checked = false;
    productItem.classList.remove('selected');
    updateSelectedProducts();
}

function openImageModal(imageSrc, caption, username, time) {
    document.getElementById('modalImage').src = imageSrc;
    document.getElementById('modalCaption').textContent = caption;
    document.getElementById('modalUsername').textContent = username;
    document.getElementById('modalTime').textContent = time;
    const modal = new bootstrap.Modal(document.getElementById('imageModal'));
    modal.show();
}

// Show product list when search input is focused
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('productSearch');
    if (searchInput) {
        searchInput.addEventListener('focus', function() {
            if (this.value.length > 0 || selectedProductIds.length > 0) {
                document.getElementById('productList').style.display = 'block';
            }
        });
    }
});
function confirmDelete(logId) {
    const form = document.getElementById('deleteForm');
    form.setAttribute('action', "{{ url('catchlog') }}/" + logId);
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>
@endsection