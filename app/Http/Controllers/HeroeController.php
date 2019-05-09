<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Heroe;
use App\Http\Resources\Heroe as HeroeResource;
use App\Http\Resources\HeroeCollection;

class HeroeController extends Controller
{

    public function index()
    {
        return new HeroeCollection(Heroe::all());
    }

    public function show($id)
    {
        return new HeroeResource(Heroe::findOrFail($id));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);
        $player = Player::create($request->all());
        return (new HeroeResource($player))
                        ->response()
                        ->setStatusCode(201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);
        $player = Heroe::findOrFail($id);
        $player->update($request->all());
        return (new HeroeResource($player))
                        ->response()
                        ->setStatusCode(201);
    }

    public function delete($id)
    {
        $player = Heroe::findOrFail($id);
        $player->delete();
        return response()->json(null, 201);
    }

    public function search(Request $request)
    {
        $products = Heroe::where('name', 'LIKE', '%' . $request->string . "%")->get();
        return new HeroeCollection($products);
    }

}
