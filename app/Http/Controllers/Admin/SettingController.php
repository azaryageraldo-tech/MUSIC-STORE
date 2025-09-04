<?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use App\Models\StoreSetting;
    use Illuminate\Http\Request;

    class SettingController extends Controller
    {
        /**
         * Menampilkan halaman form pengaturan.
         */
        public function index()
        {
            // Ambil pengaturan pertama, atau buat objek baru jika belum ada.
            $settings = StoreSetting::firstOrNew([]);
            return view('admin.settings.index', compact('settings'));
        }

        /**
         * Memperbarui atau membuat pengaturan toko.
         */
        public function update(Request $request)
        {
            $request->validate([
                'store_name' => 'nullable|string|max:255',
                'store_address' => 'nullable|string',
                'bank_details' => 'nullable|string',
                'shipping_cost' => 'required|numeric|min:0',
            ]);

            // Gunakan updateOrCreate untuk memperbarui baris yang ada atau membuat yang baru.
            // Kondisi pencarian kosong `[]` berarti akan selalu menargetkan baris pertama.
            StoreSetting::updateOrCreate([], $request->all());

            return redirect()->route('admin.settings.index')->with('success', 'Pengaturan berhasil diperbarui.');
        }
    }
    
