<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::latest()->paginate(10);

        return view('authors.index', compact('authors'));
    }

    public function create()
    {
        return view('authors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255', 'unique:authors,email'],
            'address' => ['nullable', 'string', 'max:255'],
        ]);

        Author::create($validated);

        return redirect()
            ->route('authors.index')
            ->with('success', 'Author created successfully.');
    }

    public function show(Author $author)
    {
        return view('authors.show', compact('author'));
    }

    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

    public function update(Request $request, Author $author)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => [
                'nullable',
                'email',
                'max:255',
                Rule::unique('authors', 'email')->ignore($author->id),
            ],
            'address' => ['nullable', 'string', 'max:255'],
        ]);

        $author->update($validated);

        return redirect()
            ->route('authors.index')
            ->with('success', 'Author updated successfully.');
    }

    public function destroy(Author $author)
    {
        if ($author->books()->exists()) {
            return redirect()
                ->route('authors.index')
                ->with('error', 'Cannot delete an author who has books.');
        }

        $author->delete();

        return redirect()
            ->route('authors.index')
            ->with('success', 'Author deleted successfully.');
    }
}
