<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardWork extends Model
{
    protected $fillable = ['date', 'category_id', 'po_number', 'inventory_id', 'process_id', 'customer_id', 'project_id', 'user_id'];

    public function cardWorkDetails()
    {
        return $this->hasMany(CardWorkDetail::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

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
