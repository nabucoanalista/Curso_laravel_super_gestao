<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'produtos';
    protected $fillable = ['nome', 'descricao', 'peso', 'unidade_id', 'fornecedor_id'];

    public function itemDetalhe() {
        return $this->hasOne('App\ItemDetalhe', 'produto_id', 'id');
    }

    public function fornecedor() {
        return $this->belongsTo('App\Fornecedor');
    }

    public function pedidos() {
        return $this->belongsToMany('App\Pedido', 'pedidos_produtos', 'produto_id', 'pedido_id');

        /*
            1 - Model que representa a relação N:N em relação a Model atual
            2 - É a tabela auxiliar que contém os registros de relacionamento
            3 - Representa o nome da fk da tabela auxiliar que faz referência a Model atual
            4 - Representa o nome da fk da tabela auxiliar que faz referência a Model que representa a relação N:N
        */
    }
}
