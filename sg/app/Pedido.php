<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    public function produtos()
    {
        //return $this->belongsToMany('App\Produto', 'pedidos_produtos');

        return $this->belongsToMany('App\Item', 'pedidos_produtos', 'pedido_id', 'produto_id')->withPivot('id','created_at', 'updated_at');
        /*
            1 - Model que representa a relação N:N em relação a Model atual
            2 - É a tabela auxiliar que contém os registros de relacionamento
            3 - Representa o nome da fk da tabela auxiliar que faz referência a Model atual
            4 - Representa o nome da fk da tabela auxiliar que faz referência a Model que representa a relação N:N
        */
    }
}
