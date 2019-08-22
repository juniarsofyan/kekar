<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardWorkDetail extends Model
{
    protected $fillable = ['card_work_id', 'component_id', 'problem', 'solution', 'total_hours', 'qty'];

    public function cardWorks()
    {
        return $this->belongsTo(CardWork::class);
    }
}
