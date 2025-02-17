<?php 

namespace App\Repositories;

use App\Models\Lending;
use App\Models\StuffStock;

class LendingRepository {
    public function checkStock(array $data) {
        $stuffStock = StuffStock::Where('stuff_id', $data['stuff_id'])->first();
        if ($data['total_stuff'] > $data['total_available']) {
            return response()->json('jumlah yang dipinjam lebih dari yang tersedia', 400)->send();
            exit();
        } else {
            return NULL;
        }
    }

    public function store(array $data) {
        return Lending::create($data);
    }
}
