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
        return Player::orderBy($orderBy, $sort)->paginate($count);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'age' => 'required',
            'weight' => 'required',
            'height' => 'required',
            'market_value' => 'required',
            'post' => 'required|array'
        ]);

        if ($validator->fails())
            return response()->json(['errors' => $validator->errors(), 'status_code' => 400], 400);

        $player = Player::create($request->all());

        return response()->json(['message' => 'Player Added Successfully', 'data' => $player, 'status_code' => 201], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
