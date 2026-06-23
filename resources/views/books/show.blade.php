@extends('books.layout')

@section('content')
    <div class="card">

        <div class="card-header">
            <h3>{{ $book->title }}</h3>
        </div>

        <div class="card-body">

            <p>
                <strong>Kategori:</strong>
                {{ $book->category?->name }}
            </p>

            <p>
                <strong>Penulis:</strong>
                {{ $book->author }}
            </p>

            <p>
                <strong>Penerbit:</strong>
                {{ $book->publisher }}
            </p>

            <p>
                <strong>Tahun:</strong>
                {{ $book->publication_year }}
            </p>

            <p>
                <strong>Deskripsi:</strong>
            </p>

            <p>
                {{ $book->description }}
            </p>

            <a href="{{ route('books.index') }}" class="btn btn-secondary">
                Kembali
            </a>

        </div>

    </div>
@endsection
