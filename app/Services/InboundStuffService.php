<?php 

namespace App\Services;

use App\Repositories\InboundStuffRepository;
use Illuminate\Support\Carbon;

class InboundStuffService {
    private $inboundStuffRepository;

    public function __construct(InboundStuffRepository $inboundStuffRepository) {
        $this->inboundStuffRepository = $inboundStuffRepository;
    }

    // parameter data bukan array data karna nanti akan menerima object Request dari controller

    public function store($data) {
        // jika terdapat file pada payload proof_file

        if($data->file('proof_file')) {
            $imageLink = $this->inboundStuffRepository->uploadImage($data->file('proof_file'));
        }
        // buat format array yang akan dikirim ke db
        $inboundStuff = [
            'stuff_id' => $data->stuff_id,
            'total' => $data->total,
            'date_time' => Carbon::now(),
            'proof_file' => $imageLink
        ];

        $store = $this->inboundStuffRepository->storeNewInbound($inboundStuff);
        return $store;

    }

    public function delete($id) {
        return $this->inboundStuffRepository->delete($id);
    }
}
