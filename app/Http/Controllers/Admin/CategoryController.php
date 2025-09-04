<?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use App\Models\Category;
    use Illuminate\Http\Request;
    use Illuminate\Support\Str;

    class CategoryController extends Controller
    {
        /**
        * Menampilkan daftar kategori.
        */
        public function index()
        {
            $categories = Category::latest()->paginate(10);
            return view('admin.categories.index', compact('categories'));
        }

        /**
        * Menampilkan form untuk membuat kategori baru.
        */
        public function create()
        {
            return view('admin.categories.create');
        }

        /**
        * Menyimpan kategori baru ke database.
        */
        public function store(Request $request)
        {
            $request->validate([
                'name' => 'required|string|max:255|unique:categories,name',
            ]);

            Category::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
            ]);

            return redirect()->route('admin.categories.index')->with('success', 'Kategori baru berhasil ditambahkan.');
        }

        /**
        * Menampilkan form untuk mengedit kategori.
        */
        public function edit(Category $category)
        {
            return view('admin.categories.edit', compact('category'));
        }

        /**
        * Memperbarui kategori di database.
        */
        public function update(Request $request, Category $category)
        {
            $request->validate([
                'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            ]);

            $category->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
            ]);

            return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diperbarui.');
        }

        /**
        * Menghapus kategori dari database.
        */
        public function destroy(Category $category)
        {
            $category->delete();
            return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus.');
        }
    }
