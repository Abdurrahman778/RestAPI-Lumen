<?php 

namespace App\Repositories;
// untuk memisahkan logika dengan controller, jadi isinya berupa ORM/Eloquent dengan model
use App\Models\Stuff;

// Class yang bertugas untuk melakukan operasi CRUD (Create, Read, Update, Delete) pada Stuff model
class StuffRepository
{
    public function getAllStuff()
    {
        return Stuff::paginate(10);
    }

    public function getSpecificStuff($id)
    {
        return Stuff::find($id);
    }

    public function storeNewStuff(array $data)
    {
        return Stuff::create($data);
    }

    public function updateStuff(array $data, $id)
    {
        Stuff::where('id',$id)->update($data);
        return Stuff::find($id);
    }

    public function deleteStuff($id)
    {
        return Stuff::where('id',$id)->delete();
    }
}
