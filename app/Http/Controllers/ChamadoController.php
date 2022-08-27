<?php

namespace App\Http\Controllers;

use App\Events\channelPublico;  // CANAL PUBLICO DO WEBSOCKET

use Illuminate\Http\Request;

use App\Http\Requests\ValidaChamado; // VALIDA OS CAMPOS DE CADASTRO

use App\Repositories\Eloquent\ChamadoRepository;  // REGRAS DE NEGOCIOS



use NotificationChannels\Telegram\TelegramChannel;
use App\Notifications\TelegramNotification;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Notification;

use App\Models\Chamado;

use PDF;

class ChamadoController extends Controller
{

    // RETORNA A TELA DE CHAMADO
    public function create()
    {
        return view('chamado.chamado');
    }

    // MEDOTO DE SALVA
    public function store(ValidaChamado $request, ChamadoRepository $model)
    {
        $data = $request->all();
        $data['date_chamado_aberto'] = date('Y-m-d H:i:s');
        $data['nome'] = ucwords($data['nome']);

        $model->store($data); // SALVA

        broadcast(new channelPublico(response()->json($data)));  // REAL TIME DO NOVO CHAMADO

        return redirect('/chamado')->with('msg', 'Olá '.$data['nome'].', seu chamado foi realizado!');
    }

    public function update(Request $request, $id)
    {
        //
    }

    // RETORNA LISTA DE CHAMADO
    public function painel(ChamadoRepository $model)
    {
        $chamadosDay = $model->listaDay();

        return view('dashboard.home', ['chamadosDay' => $chamadosDay]);

    }

    // FECHA CHAMADO
    public function finalizarChamado(Request $request, ChamadoRepository $model)
    {
        $model->finalizarChamado($request->id);
        return redirect('/home')->with('msg', 'Chamado finalizado com sucesso!');
    }

    // QUANTIDADE DE CHAMADOS
    public function chamadosRealizados(ChamadoRepository $model)
    {
        $lista = $model->chamados();

        return view('dashboard.resumo', ['lista' => $lista]);
    }

    // DISPARA TELEGRAM
    public function disparaMessagem($nome, $setor, $descricao){

        $nome = request('nome'); // PARAMETRO URL
        $setor = request('setor'); // PARAMETRO URL
        $descricao = request('descricao'); // PARAMETRO URL

        Notification::route('telegram' , Config::get('services.telegram_id'))
        ->notify(new TelegramNotification($nome, $setor, $descricao));
    }

    // GERA RELATORIO EM PDF
    public function geraRelatorio(ChamadoRepository $model)
    {
        $chamados = $model->relatorio();   
        $pdf = PDF::loadView('export.relatorioPDF', compact('chamados'));
        return  $pdf->setPaper('a4')->stream('Relatorio_Chamado.pdf');        
    }

}
