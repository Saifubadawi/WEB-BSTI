@extends('books.layout')

@section('content')
    <h2 class="mb-4">
        Tambah Buku
    </h2>

    <div class="card">

        <div class="card-body">

            <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @include('books.form')

                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>
            </form>
        </div>

    </div>
@endsection
