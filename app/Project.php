<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['code', 'date', 'customer_id'];

    public function category()
    {
        return $this->hasMany('App\Category');
    }

    public function inventory()
    {
        return $this->hasMany('App\Inventory');
    }

    public function process()
    {
        return $this->hasMany('App\Process');
    }

    public function customer()
    {
        return $this->hasMany('App\Customer');
    }

    public function projectDetail()
    {
        return $this->hasMany('App\ProjectDetail');
    }

    public function user()
    {
        return $this->hasMany('App\User');
    }
}
