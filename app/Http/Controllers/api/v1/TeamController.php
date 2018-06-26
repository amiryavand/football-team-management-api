<?php

namespace App\Http\Controllers\api\v1;

use App\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TeamController extends Controller
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
        return Team::orderBy($orderBy, $sort)->with('players')->paginate($count);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validationRoles());
        if ($validator->fails())
            return response()->json(['errors' => $validator->errors(), 'status_code' => 400], 400);

        $team = Team::create($request->all());
        return response()->json(['message' => 'Team Added Successfully', 'data' => $team, 'status_code' => 201], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Team $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        return response()->json(['data' => $team, 'status_code' => 200], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Team $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        $team->update($request->all());
        return response()->json(['message' => 'Team Updated Successfully', 'data' => $team, 'status_code' => 200], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Team $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        $team->delete();
        return response()->json([], 204);
    }

    /**
     * @return array
     */
    private function validationRoles()
    {
        return [
            'name' => 'required',
            'type' => 'required|in:club,national',
            'rank' => 'required'
        ];
    }
}
