<?php 

namespace App\Services;
// memisahkan business logic dengan controller. proses manipulasid dari repositories

use App\Repositories\StuffRepository;

class StuffService {
    private $stuffRepository;

    public function __construct(StuffRepository $stuffRepository)
    {
        $this->stuffRepository = $stuffRepository;
    }

    public function index()
    {
        return $this->stuffRepository->getAllStuff();
    }

    public function store(array $data)
    {
        return $this->stuffRepository->storeNewStuff($data);
    }

    public function show($id)
    {
        return $this->stuffRepository->getSpecificStuff($id);
    }

    public function update(array $data, $id)
    {
        return $this->stuffRepository->updateStuff($data, $id);
    }

    public function destroy($id)
    {
        return $this->stuffRepository->deleteStuff($id);
    }
}