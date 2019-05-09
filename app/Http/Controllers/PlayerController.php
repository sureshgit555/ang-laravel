<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Player;
use App\Http\Resources\Player as PlayerResource;
use App\Http\Resources\PlayerCollection;

class PlayerController extends Controller
{

    public function index()
    {
        return new PlayerCollection(Player::all());
    }

    public function show($id)
    {
        return new PlayerResource(Player::findOrFail($id));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|max:255',
        ]);
        $player = Player::create($request->all());
        return (new PlayerResource($player))
                        ->response()
                        ->setStatusCode(201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|max:255',
        ]);

        $player = Player::findOrFail($id);
        $player->update($request->all());
        return (new PlayerResource($player))
                        ->response()
                        ->setStatusCode(201);
    }

    public function delete($id)
    {
        $player = Player::findOrFail($id);
        $player->delete();
        return response()->json(null, 201);
    }

}
