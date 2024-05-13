<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    use HasFactory;

    protected $table = 'pagamentos';

    protected $fillable = [
        'inscricao_id','collection_id', 'collection_status', 'payment_id', 'status', 
        'external_reference', 'payment_type', 'merchant_order_id', 'preference_id', 
        'site_id', 'processing_mode', 'merchant_account_id' 
    ];
}
