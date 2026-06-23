@extends('books.layout')

@section('content')
    <h2 class="mb-4">
        Edit Buku
    </h2>

    <div class="card">
        <div class="card-body">

            <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                @include('books.form')

                <button type="submit" class="btn btn-warning">
                    Update
                </button>

            </form>

        </div>
    </div>
@endsection
