<?php

namespace App\Repositories;

use App\Models\InboundStuff;
use App\Models\StuffStock;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class InboundStuffRepository
{
    public function uploadImage($file)
    {
        // membuat nama file unik dengan str::random
        $imageName = Str::random(5) . '_' . $file->getClientOriginalName();
        // upload file ke folder public/images
        $storageDirectory = storage_path('app/public/images');
        // cek jika directory belum ada maka dibuat dulu
        if (!File::exists($storageDirectory)) {
            // 0755 : mengatur hak akses pengguna, agar file bisa dilihat public namun tidak dimodifikasi oleh public kecuali owner
            File::makeDirectory($storageDirectory, 0755, true);
        }

        // pindahkan file ke folder public/images
        $file->move($storageDirectory, $imageName);

        // membuat symlink antara folder storage dengan public, agar gambar bisa dimunculan melalui uml
        $publicDirectory = base_path('public/storage');
        // symlink file yang diupload ke folder public
        if (!File::exists($publicDirectory)) {
            File::link(storage_path('app/public'), $publicDirectory);
        }

        // link untuk menampillan gambar nantinya
        $imageLink = env('APP_URL') . 'storage/images/' . $imageName;
        return $imageLink;
    }

    public function storeNewInbound(array $data)
    {
        return InboundStuff::create($data);
    }

    public function delete ($id) {
        $inboundStuff = InboundStuff::find($id);
        $stuffStock = StuffStock::where('stuff_id', $inboundStuff->stuff_id)->first();

        // if ($inboundStuff->total < $stuffStock->total_available) {
        //     response()->json('Total Stuff Tidak Cukup', 400)->send();
        //     exit();
        // }

        if ($inboundStuff->total > $stuffStock->total_available) {
            // response()->json('Stuff Total is not available', 400)->send();
            // exit();
            throw new \Exception('Stuff Total is not available');
        }

        $stuffStock->total_available -= $inboundStuff->total;
        $stuffStock->save();

        $imagePath = storage_path('app/public/images/' . basename($inboundStuff->proof_file));
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $inboundStuff->delete();

        return $inboundStuff;
    }
}
