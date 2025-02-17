<?php 

namespace App\Repositories;

use App\Models\StuffStock;

class StuffStockRepository
{
    public function update(array $data)
    {
        $stuffStock = StuffStock::where('stuff_id', $data['stuff_id'])->first();
        $totalAvailableBefore = $stuffStock ? $stuffStock['total_available'] : 0;
        $totalDefecBefore = $stuffStock ? $stuffStock['total_defec'] : 0;

        StuffStock::updateOrCreate([
            'stuff_id' => $data['stuff_id'],
        ], [
            'total_available' => $totalAvailableBefore + $data['total'], 
            'total_defec' => $totalDefecBefore,
        ]);

        return StuffStock::where('stuff_id', $data['stuff_id'])->first();
    }
}