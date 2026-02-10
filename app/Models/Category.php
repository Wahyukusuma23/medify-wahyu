<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Model\MasterItem;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'category';

    public function products()
    {
        return $this->belongsToMany(MasterItem::class,
            'master_item_category',
            'category_id',
            'master_items_id'
            );
    }
}
