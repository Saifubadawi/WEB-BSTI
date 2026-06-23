<div class="mb-3">
    <label class="form-label">Kategori</label>

    <select name="category_id" class="form-select" required>

        <option value="">Pilih Kategori</option>

        @foreach ($categories as $category)
            <option value="{{ $category->id }}"
                {{ old('category_id', $book->category_id ?? '') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach

    </select>
</div>

<div class="mb-3">
    <label class="form-label">Judul Buku</label>

    <input type="text" name="title" class="form-control" value="{{ old('title', $book->title ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Penulis</label>

    <input type="text" name="author" class="form-control" value="{{ old('author', $book->author ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Penerbit</label>

    <input type="text" name="publisher" class="form-control" value="{{ old('publisher', $book->publisher ?? '') }}"
        required>
</div>

<div class="mb-3">
    <label class="form-label">Tahun Terbit</label>

    <input type="number" name="publication_year" class="form-control"
        value="{{ old('publication_year', $book->publication_year ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Deskripsi</label>

    <textarea name="description" rows="4" class="form-control" required>{{ old('description', $book->description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label">Cover Buku</label>

    <input type="file" name="cover_image" class="form-control">

    @if (isset($book) && $book->cover_image_path)
        <div class="mt-2">
            <small class="text-muted">
                Cover saat ini tersedia
            </small>
        </div>
    @endif
</div>
