<?php 

namespace App\Services;

use App\Repositories\StuffStockRepository;
class StuffStockService
{
    private $stuffStockRepository;
    public function __construct(StuffStockRepository $StuffStockRepository)
    {
        $this->stuffStockRepository = $StuffStockRepository;   
    }

    public function update(array $data)
    {
        return $this->stuffStockRepository->update($data);
    }
}
