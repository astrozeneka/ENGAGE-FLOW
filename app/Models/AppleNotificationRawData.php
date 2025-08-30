<?php

namespace App\Models;

use App\Casts\MillisecondsToDateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AppleNotificationRawData extends Model
{
    use HasFactory;
    // Specify table name
    protected $table = 'apple_notification_raw_data';
    // Specify fields that can be filled
    protected $fillable = [
        'type', 'subtype',
        
        'uuid', 'data', 'version',
        'transaction_id', 'original_transaction_id', 'transactionReason', 'inAppOwnershipType', 'product_type', 'quantity', 'price', 'currency', 'environment', 'purchase_date', 'original_purchase_date',
        'payment_id',
        'product_id'
    ];
    // Data conversion
    protected $casts = [
        'purchase_date'         => MillisecondsToDateTime::class,
        'original_purchase_date' => MillisecondsToDateTime::class,
    ];

    // Payment foreign entity by the payment_id
    public function payment(){
        return $this->belongsTo(Payment::class);
    }
}
