<?php

namespace App\Repositories\Eloquent;

use App\Models\Chamado;
use App\Models\ResmaPapel;

use PDF;

class ChamadoRepository extends AbstractRepository{

    protected $model = Chamado::class;  // PASSA A VARIAVEL $model PARA AbstractRepository

    public function listaDay()
    {
        // LISTA DE CHAMADOS
        $agora = date('Y-m-d');
        $listChamado = Chamado::where([['date_chamado_aberto', '>', $agora]])->orderBy('id', 'DESC')->take(20)->get(); // PEGA OS 20 1°

        // LISTA DE PEDIDO DE PAPEIS
        $ontem = date('Y-m-d 00:00:00' , strtotime("-1 days", strtotime($agora)));
        $resmaPapel = ResmaPapel::where([['date_solicitacao_aberto', '>', $ontem]])->orderBy('id', 'DESC')->take(30)->get(); // PEGA OS 30 1°

        return ['listChamado' => $listChamado, 'resmaPapel' => $resmaPapel];  // RETORNA CHAMADOS E PEDIDOS
    }

    // FECHA CHAMADO POR ID
    public function finalizarChamado($id)
    {
        $usuario = auth()->user(); // PEGA O USER LOGADO E ATRIBUI EM VARIAVEL

        $fechado = date('Y-m-d H:i:s');

        return $this->model->find($id)->update(["date_chamado_fechado" => $fechado, "user_id" => $usuario->id]);
    }

    // QUANTIDADE DE CHAMADOS
    public function chamados()
    {
        $hoje = date('Y-m-d');

        $ontem = date('Y-m-d 00:00:00' , strtotime("-1 days", strtotime($hoje)));

        $all = Chamado::all()->count();  // RETORNA QUANTIDADE TOTAL

        $today = Chamado::where([['date_chamado_aberto', '>', $hoje]])->orderBy('id', 'DESC')->take(30)->get()->count(); // PEGA OS 30 1°

        $yesterday = $this->model
        ->where([['date_chamado_aberto', '<', $hoje]])
        ->where('date_chamado_aberto', '>', $ontem)
        ->orderBy('id', 'DESC')
        ->take(50)->get()
        ->count(); // PEGA OS 50 1°
        
        return ['all' => $all, 'today' => $today, 'yesterday' => $yesterday];  // RETORNA A QUANTIDADE DE CHAMADOS
    }

    // RELATORIO DE CHAMADOS|RESMA
    public function relatorio()
    {
        $hoje = date('Y-m-d');
        $chamado = request('chamado'); // PARAMETRO URL
        $solicitacaoPapel = request('solicitacaoPapel'); 
        $dataOne = request('dataOne');
        $dataTwo = request('dataTwo'); 

        //dd($chamado);

        $dataTwoF = date('Y-m-d 00:00:00' , strtotime("+1 days", strtotime($dataTwo)));

        if(!$dataOne && $dataTwo){ // SE SELECIONAR APENAS A 2° DATA
            $dataOne = $hoje;
        }

        if(!$chamado && !$solicitacaoPapel){
            $chamado = true;
            $solicitacaoPapel = true;
        }        

        if(!$dataOne && !$dataTwo){ // RETORNA TODAS AS DATAS        
            
            $listChamado = Chamado::orderBy('id', 'DESC')->get(); // LISTA DE CHAMADOS
            
            $resmaPapel = ResmaPapel::orderBy('id', 'DESC')->get(); // LISTA DE PEDIDO DE PAPEIS

            if($chamado && $solicitacaoPapel)
            {
                $chamados = ['listChamado' => $listChamado, 'resmaPapel' => $resmaPapel];  // RETORNA CHAMADOS E PEDIDOS
            }elseif($chamado)
            {
                $chamados = ['listChamado' => $listChamado, 'resmaPapel' => ''];  // RETORNA CHAMADOS E PEDIDOS
            }elseif($solicitacaoPapel)
            {
                $chamados = ['resmaPapel' => $resmaPapel, 'listChamado' => ''];  // RETORNA CHAMADOS E PEDIDOS
            }
            return  $chamados;
        }   
        
        if($dataOne || $dataTwo){ // RETORNA DATAS EPECIFICAS

            if($dataOne && !$dataTwo){ // CASO MARQUE SOMENTE 1° DATA
                $dataTwoF = date('Y-m-d 00:00:00' , strtotime("+1 days", strtotime($dataOne)));
            }
            
            $listChamado = Chamado::where([['date_chamado_aberto', '>', $dataOne]])
                                    ->where('date_chamado_aberto', '<', $dataTwoF)
                                    ->orderBy('id', 'DESC')->get();

            $resmaPapel = ResmaPapel::where([['date_solicitacao_aberto', '>', $dataOne]])
                                    ->where('date_solicitacao_aberto', '<', $dataTwoF)
                                    ->orderBy('id', 'DESC')->get();

            if($chamado && $solicitacaoPapel)
            {
                $chamados = ['listChamado' => $listChamado, 'resmaPapel' => $resmaPapel];  // RETORNA CHAMADOS E PEDIDOS
            }elseif($chamado)
            {
                $chamados = ['listChamado' => $listChamado, 'resmaPapel' => ''];  // RETORNA CHAMADOS E PEDIDOS
            }elseif($solicitacaoPapel)
            {
                $chamados = ['resmaPapel' => $resmaPapel, 'listChamado' => ''];  // RETORNA CHAMADOS E PEDIDOS
            }
            return  $chamados;
        }

    }

}