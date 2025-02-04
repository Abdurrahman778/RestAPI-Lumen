<?php 

namespace App\Repositories;

use App\Models\InboundStuff;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class InboundStuffRepository {
    public function uploadImage($file) {
        // membuat nama file unik dengan str::random
        $imageName = Str::random(5) . '_' . $file->getClientOriginalName();
        // upload file ke folder public/images
        $storageDirectory = storage_path('app/[ublic/images');
        // cek jika directory belum ada maka dibuat dulu
        if (!File::exists($storageDirectory)){
            // 0755 : mengatur hak akses pengguna, agar file bisa dilihat public namun tidak dimodifikasi oleh public kecuali owner
            File::makeDirectory($storageDirectory, 0755, true);
        }

        // pindahkan file ke folder public/images
        $file->move($storageDirectory, $imageName);

        // membuat symlink antara folder storage dengan public, agar gambar bisa dimunculan melalui uml
        $publicDirectory =  base_path('public/images');
        // symlink file yang diupload ke folder public
        if (!File::exists($publicDirectory)) {
            File::link(storage_path('app/public'), $publicDirectory);
        } 
    }

    public function store(array $data) {
        return InboundStuff::create($data);
    }
}
