<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('reports')->orderBy('nama_kategori')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:categories,nama_kategori',
            'deskripsi'     => 'nullable|string|max:255',
            'icon'          => 'nullable|string|max:10',
        ]);

        Category::create([
            'nama_kategori' => $data['nama_kategori'],
            'deskripsi'     => $data['deskripsi'] ?? null,
            'icon'          => $data['icon'] ?? '📋',
            'aktif'         => true,
        ]);

        return back()->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'nama_kategori' => "required|string|max:100|unique:categories,nama_kategori,{$category->id}",
            'deskripsi'     => 'nullable|string|max:255',
            'icon'          => 'nullable|string|max:10',
            'aktif'         => 'boolean',
        ]);

        $category->update($data);
        return back()->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category)
    {
        if ($category->reports()->exists()) {
            return back()->with('error', 'Kategori tidak bisa dihapus karena masih digunakan laporan.');
        }
        $category->delete();
        return back()->with('success', 'Kategori berhasil dihapus.');
    }
}
