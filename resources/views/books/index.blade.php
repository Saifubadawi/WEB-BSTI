@extends('books.layout')

@php
    use Illuminate\Support\Str;
@endphp

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Daftar Buku</h2>

        <a href="{{ route('books.create') }}" class="btn btn-primary">
            + Tambah Buku
        </a>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <form method="GET" action="{{ route('books.index') }}">

                <div class="row g-3">

                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="Cari judul atau penulis"
                            value="{{ request('search') }}">
                    </div>

                    <div class="col-md-3">
                        <select name="category_id" class="form-select">

                            <option value="">
                                Semua Kategori
                            </option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ request('category_id') == $category->id ? 'selected' : '' }}>

                                    {{ $category->name }}

                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="col-md-3">
                        <select name="publication_year" class="form-select">

                            <option value="">
                                Semua Tahun
                            </option>

                            @for ($year = date('Y'); $year >= 2010; $year--)
                                <option value="{{ $year }}"
                                    {{ request('publication_year') == $year ? 'selected' : '' }}>

                                    {{ $year }}

                                </option>
                            @endfor

                        </select>
                    </div>

                    <div class="col-md-2 d-grid">
                        <button type="submit" class="btn btn-primary">
                            Cari
                        </button>
                    </div>

                </div>

            </form>

        </div>
    </div>

    @if ($books->count())
        <div class="row">

            @foreach ($books as $book)
                <div class="col-md-4 mb-4">

                    <div class="card h-100 shadow-sm border-0">

                        <img src="{{ $book->cover_image_path ? Storage::disk('s3')->url($book->cover_image_path) : 'https://placehold.co/400x500' }}"
                            class="card-img-top" alt="{{ $book->title }}">
                        <div class="card-body">

                            <h5 class="card-title">
                                {{ $book->title }}
                            </h5>

                            <p class="text-muted mb-2">
                                {{ $book->author }}
                            </p>

                            <span class="badge bg-primary mb-3">
                                {{ $book->category->name }}
                            </span>

                            <p class="card-text">
                                {{ Str::limit($book->description, 100) }}
                            </p>

                        </div>

                        <div class="card-footer bg-white">

                            <div class="d-flex gap-2">

                                <a href="{{ route('books.show', $book->id) }}" class="btn btn-info btn-sm flex-fill">

                                    Detail

                                </a>

                                <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning btn-sm flex-fill">

                                    Edit

                                </a>

                            </div>

                        </div>

                    </div>

                </div>
            @endforeach

        </div>

        <div class="mt-4">
            {{ $books->links() }}
        </div>
    @else
        <div class="alert alert-info">
            Belum ada data buku.
        </div>
    @endif

@endsection
