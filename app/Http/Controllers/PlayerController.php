<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use App\Models\Team;

class PlayerController extends Controller
{
    /*public function players() {   

        return view('app.players');
    }*/

    public function players($id) {

        $team = Team::findOrFail($id);
        $players = $team->players;

        return view('app.players', ['players' => $players]);
    }

    public function update(Request $request){
        Player::findOrFail($request->id)->update($request->all());
        $team = Player::findOrFail($request->id)->team_id;

        return redirect('/app/teams');
    }

    public function destroy($id) {
        Player::findOrFail($id)->delete();

        return redirect('/app/teams');
    }

}
