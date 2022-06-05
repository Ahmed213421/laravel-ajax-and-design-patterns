<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    use HasFactory;
    protected $table = 'invoicedetails';
    protected $fillable = [
        'invoice_id',
        'invoice_status',
        'CreatedDate',
        'ExpiryDate',
        'CustomerName',
        'payment_id',
        'CustomerMobile',
        'status',
    ];
}
