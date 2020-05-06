<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Models\Refeicao;
use App\Models\Ticket;
use App\Models\Auxilio;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [];

        $refeicaos = Refeicao::all();

        foreach($refeicaos as $refeicao){
            $ticketsToday = Ticket::where('refeicao_id',$refeicao->id)->whereDate('created_at', Carbon::today())->get();
            $auxilios = Auxilio::where('refeicao_id',$refeicao->id)->get();
            $data[$refeicao->nome] = [$ticketsToday,$auxilios, $refeicao];
        }
        
        return view('home.home',compact('data'));
    }
}
