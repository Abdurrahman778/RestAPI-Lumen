<?php 

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class StuffCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
