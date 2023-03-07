<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ComConvencaoAlunoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "nome_aluno" => $this->nome,
            "nascimento" => $this->nascimento,
            "genero" => $this->genero,
            "turma" => $this->turma_id
        ];
    }
}
