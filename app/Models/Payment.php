<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "amount",
        "datetime",
        "permalink",
        "description",

        "stripe_intent_id", // unused,
        "reference",
        "status",
        "currency",
        "fees",
        "customer",
        "receipt_url",
        "subscription_id",

        "stripe_subscription_id",

        // Used for the iOS in-app purchase
        "deviceVerificationNonce",
        "deviceVerification",
        "inAppOwnershipType",
        "signedDate",

        "product_id",
        "lastVerificationOn",

        // Newly added columns from iOS IAP
        "transaction_id",
        "original_transaction_id",
        "purchase_date",
        "original_purchase_date",
        "type",
        "environment",
        "storefront",

        // Newly added columns for Andorid IAP
        'purchase_token',
        'purchase_state',
        'quantity',
        'acknowledged'
    ];

    protected $casts = [
        'datetime' => 'datetime',
        // 'purchase_date' => 'datetime',
        // 'original_purchase_date' => 'datetime',
        // 'lastVerificationOn' => 'datetime' (unused anymore, should be deleted)
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function perishable(){
        // Raise unimplemented
        throw new \Exception("Not implemented");
    }
}
