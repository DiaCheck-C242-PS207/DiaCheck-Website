<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ArticlesController extends Controller
{
    public function index()
    {
        return view('pages.articles', [
            'title' => 'Articles - DiaCheck',
            'active' => 'articles'
        ]);
    }

    public function create()
    {
        return view('pages.admin.create-article', [
            'title' => 'Create Article - DiaCheck',
            'active' => 'articles',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:articles|max:255',
        ], [
            'title.unique' => 'Title already exists.',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('thumbnails', $fileName, 'public');

            $data['thumbnail'] = $fileName;
        }
        
        $article = Articles::create($data);

        if ($article) {
            return redirect()->route('articles.index')->with('success', 'Article successfully created!');
        } else {
            return redirect()->route('articles.index')->with('error', 'Article failed to create!');
        }
    }

    public function show($slug)
    {
        $article = Articles::where('slug', $slug)->firstOrFail();
        $author = $article->user;

        return view('pages.article-detail', [
            'title' =>  $article->title . ' - DiaCheck',
            'active' => 'articles',
            'article' => $article,
            'author' => $author
        ]);
    }

    public function edit($slug)
    {
        $article = Articles::where('slug', $slug)->first();

        if (Auth::user()->roles == 'admin') {
            return view('pages.admin.edit-article', [
                'title' => 'Edit Article - DiaCheck',
                'active' => 'articles',
                'article' => $article,
            ]);
        } else {
            return redirect()->route('articles.index')->with('error', 'You do not have access to edit this article!');
        }
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => [
                'required',
                Rule::unique('articles')->ignore($id),
                'max:255',
            ],
        ], [
            'title.unique' => 'Title already exists.',
        ]);

        $article = Articles::find($id);
        $article->title = $request->input('title', $article->title);
        $article->body = $request->input('body', $article->body);
        $article['slug'] = Str::slug($request->title);

        if ($request->hasFile('thumbnail')) {
            // Hapus file lama jika ada
            if ($article->thumbnail) {
                Storage::disk('public')->delete('thumbnails/' . $article->thumbnail);
            }

            $file = $request->file('thumbnail');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('thumbnails', $fileName, 'public');

            $article->thumbnail = $fileName;
        }
        
        $article->save();

        if ($article) {
            return redirect()->route('articles.index')->with('success', 'Article successfully edited!');
        } else {
            return redirect()->route('articles.index')->with('error', 'Article failed to edit!');
        }
    }

    public function destroy($id)
    {
        $article = Articles::find($id);

        if ($article->thumbnail) {
            Storage::disk('public')->delete('thumbnails/' . $article->thumbnail);
        }

        $article->delete();

        if ($article) {
            return redirect()->route('articles.index')->with('success', 'Article successfully deleted!');
        } else {
            return redirect()->route('articles.index')->with('error', 'Article failed to delete!');
        }
    }
}
