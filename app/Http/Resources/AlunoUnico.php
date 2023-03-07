<?php

namespace App\Http\Resources;

use App\Services\LinksGenerator;
use Illuminate\Http\Resources\Json\JsonResource;

class AlunoUnico extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $links = new LinksGenerator;
        $links->get(route("alunos.show", $this->id), "alunos_detalhes");
        $links->put(route("alunos.update", $this->id), "alunos_atualizar");
        $links->delete(route("alunos.destroy", $this->id), "alunos_remover");


        return [
            "id" => $this->id,
            "nome_aluno" => $this->nome,
            // "turma" => new TurmaResource($this->turma)
            "turma" => new TurmaResource($this->whenLoaded("turma")),
            //implementando HATEOAS
            "links" => $links->toArray(),
        ];
    }
}
