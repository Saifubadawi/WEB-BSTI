<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('category')
            ->latest()
            ->paginate(6);

        $categories = Category::all();

        return view('books.index', compact(
            'books',
            'categories'
        ));
    }

    public function create()
    {
        $categories = Category::all();

        return view('books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'publisher' => 'required|max:255',
            'publication_year' => 'required|integer',
            'description' => 'required',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        $coverPath = null;

        if ($request->hasFile('cover_image')) {

            $coverPath = Storage::disk('s3')->put(
                'covers',
                $request->file('cover_image')
            );
        }

        Book::create([
            'category_id' => $validated['category_id'],
            'title' => $validated['title'],
            'author' => $validated['author'],
            'publisher' => $validated['publisher'],
            'publication_year' => $validated['publication_year'],
            'description' => $validated['description'],
            'cover_image_path' => $coverPath,
        ]);

        return redirect()
            ->route('books.index')
            ->with('success', 'Buku berhasil ditambahkan');
    }
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }
    public function edit(Book $book)
    {
        $categories = Category::all();

        return view('books.edit', compact(
            'book',
            'categories'
        ));
    }
}
