<?php

namespace App\Http\Controllers\api\v1;

use App\Player;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count = \request()->has('count') ? \request('count') : 10;
        $orderBy = \request()->has('order_by') ? \request('order_by') : 'created_at';
        $sort = \request()->has('sort') ? \request('sort') : 'desc';
        return Player::orderBy($orderBy, $sort)->with(['teams' => function ($query) {
            $query->select('teams.id', 'teams.name', 'teams.type')->get();
        }])->paginate($count);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validationRoles());
        if ($validator->fails())
            return response()->json(['errors' => $validator->errors(), 'status_code' => 400], 400);

        $player = Player::create($request->all());
        return response()->json(['message' => 'Player Added Successfully', 'data' => $player, 'status_code' => 201], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Player $player
     * @return \Illuminate\Http\Response
     */
    public function show(Player $player)
    {
        return response()->json(['data' => $player, 'status_code' => 200], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Player $player
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Player $player)
    {
        $player->update($request->all());
        return response()->json(['message' => 'Player Updated Successfully', 'data' => $player, 'status_code' => 200], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Player $player
     * @return \Illuminate\Http\Response
     */
    public function destroy(Player $player)
    {
        $player->delete();
        return response()->json([], 204);
    }

    /**
     * @return array
     */
    private function validationRoles()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'age' => 'required',
            'weight' => 'required',
            'height' => 'required',
            'market_value' => 'required',
            'post' => 'sometimes|required|array'
        ];
    }
}
