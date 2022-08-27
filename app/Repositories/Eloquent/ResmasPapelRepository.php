<?php

namespace App\Repositories\Eloquent;

use App\Models\ResmaPapel;

class ResmasPapelRepository extends AbstractRepository{

    protected $model = ResmaPapel::class;  // PASSA A VARIAVEL $model PARA AbstractRepository
 
    public function yesterDayToday()  // SOLICITACOES DE ONTEM E HOJE 
    {
        $hoje = date('Y-m-d');

        $ontem = date('Y-m-d 00:00:00' , strtotime("-1 days", strtotime($hoje)));

        $listChamado = ResmaPapel::where([['date_solicitacao_aberto', '>', $ontem]])->orderBy('id', 'DESC')->take(30)->get(); // PEGA OS 30 1°
        return $listChamado; 
    }
 
    // FECHA CHAMADO POR ID
    public function liberarPapel($id)
    {
        $usuario = auth()->user(); // PEGA O USER LOGADO E ATRIBUI EM VARIAVEL

        $fechado = date('Y-m-d H:i:s');

        $status = 'Liberado';

        return $this->model->find($id)->update(["date_solicitacao_fechado" => $fechado, "status_solicitacao" => $status, "user_id" => $usuario->id]);
    }
}