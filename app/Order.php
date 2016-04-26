<?php

namespace CodeCommerce;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = [
        'user_id',
        'total',
        'status'
    ];

    public function items()
    {
        return $this->hasMany('CodeCommerce\OrderItem');
    }

    public function user()
    {
        return $this->belongsTo('CodeCommerce\User');
    }

    public function getStatus()
    {
        switch ($this->attributes['status'])
        {
            case 0:
                return 'Aguardando Pagamento/Pendente';
                break;
            case 1:
                return 'Produto Enviado';
                break;
            case 2:
                return 'Cancelado';
                break;
        }
    }
}
