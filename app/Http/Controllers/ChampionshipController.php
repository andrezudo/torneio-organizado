<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Championship;
use App\Models\Team;

class ChampionshipController extends Controller
{
    public function campeonatos() {
        //$championships = Championship::all();

        $user = auth()->user();
        $championships = $user->championships;        

        return view('app.campeonatos', ['championships' => $championships]);
    }

    public function painel($id) {
        $user = auth()->user();
        $teams = $user->teams;

        $championship = Championship::findOrFail($id);

        return view('app.painel', ['championship' => $championship, 'teams' => $teams]);
    }

    public function campeonato($id) {
        $user = auth()->user();
        $teams = $user->teams;

        $championship = Championship::findOrFail($id);

        return view('site.campeonato', ['championship' => $championship, 'teams' => $teams]);
    }

    public function store(Request $request) {
        $championship = new Championship;
        $forma = $request->forma;
        
        $championship->title = $request->title;
        $championship->localization = $request->localization;
        if ($request->award == '') {
            $championship->award = '';
        }else {
            $championship->award = $request->award;
        }
        $championship->modality = $request->modality;
        if ($forma == '1') {
            $championship->mata_mata = '1';
            $championship->groups = '0';
            $championship->running_stitches = '0';
        }elseif ($forma == '2') {
            $championship->groups = '1';
            $championship->mata_mata = '0';
            $championship->running_stitches = '0';
        }elseif ($forma == '3') {
            $championship->groups = '0';
            $championship->mata_mata = '0';
            $championship->running_stitches = '1';
        }
        $championship->return = $request->return;

        $user = auth()->user();
        $championship->user_id = $user->id;

        $championship->save();

        return redirect('/app/campeonatos');
    }

    public function destroy($id) {
        Championship::findOrFail($id)->delete();

        return redirect('/app/campeonatos');
    }

    public function update(Request $request){
        Championship::findOrFail($request->id)->update($request->all());

        return redirect('/app/campeonatos');
    }

}
