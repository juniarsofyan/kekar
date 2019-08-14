<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardWork extends Model
{
    protected $fillable = ['date', 'category_id', 'po_number', 'inventory_id', 'process_id', 'customer_id', 'project_id', 'user_id', 'officer_id'];

    public function cardWorkDetails()
    {
        return $this->hasMany(CardWorkDetail::class);
    }
}
