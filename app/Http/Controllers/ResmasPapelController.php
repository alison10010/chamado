<?php

namespace App\Http\Controllers;

use App\Events\channelPublico;  // CANAL PUBLICO DO WEBSOCKET

use App\Events\aprovaResmaPapel;  // CANAL PUBLICO DO WEBSOCKET RESMA PAPEL

use Illuminate\Http\Request;

use App\Http\Requests\ValidaChamado; // VALIDA OS CAMPOS

use App\Repositories\Eloquent\ResmasPapelRepository;  // REGRAS DE NEGOCIOS

class ResmasPapelController extends Controller
{
    // MEDOTO DE SALVA
    public function store(ValidaChamado $request, ResmasPapelRepository $model)
    {
        $data = $request->all();
        $data['date_solicitacao_aberto'] = date('Y-m-d H:i:s');
        $data['nome'] = ucwords($data['nome']);
        $data['status_solicitacao'] = 'Pendente';

        $model->store($data); // SALVA

        broadcast(new channelPublico(response()->json($data)));  // REAL TIME DO NOVO CHAMADO

        return redirect('/papel')->with('msg', 'Olá '.$data['nome'].', sua solicitação foi realizada!');
    }

    // RETORNA LISTA DE SOLICITACAO COM DATA DETERMINADA
    public function painel(ResmasPapelRepository $model)
    {
        $yesterDayToday = $model->yesterDayToday();

        return view('chamado.papel', ['yesterDayToday' => $yesterDayToday]);

    }

    // FECHA CHAMADO
    public function liberarPapel(Request $request, ResmasPapelRepository $model)
    {
        $model->liberarPapel($request->id);
        
        broadcast(new aprovaResmaPapel(response()->json('')));  // REAL TIME DO NOVO CHAMADO

        return redirect('/home')->with('msg', 'Liberação de Papel realizado!');
    }

}
