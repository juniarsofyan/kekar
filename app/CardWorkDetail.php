<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardWorkDetail extends Model
{
    protected $fillable = ['card_work_id', 'component_id', 'material_id', 'dimension', 'problem', 'solution', 'total_hours', 'qty', 'weight'];

    public function cardWorks()
    {
        return $this->belongsTo(CardWork::class);
    }
}
