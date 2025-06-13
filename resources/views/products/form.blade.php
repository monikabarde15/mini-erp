<div class="mb-3">
    <label>Name</label>
    <input type="text" name="name" class="form-control"
           value="{{ old('name', $product->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label>SKU</label>
    <input type="text" name="sku" class="form-control"
           value="{{ old('sku', $product->sku ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Price</label>
    <input type="number" step="0.01" name="price" class="form-control"
           value="{{ old('price', $product->price ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Quantity</label>
    <input type="number" name="quantity" class="form-control"
           value="{{ old('quantity', $product->quantity ?? '') }}" required>
</div>
