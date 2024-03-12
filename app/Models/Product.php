<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Group;

class Product extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';
    protected $fillable = ['id', 'group_ID', 'name', 'description'];

    /**
     * Get the products for the group.
     */
    public function group()
    {
        return $this->belongsTo(Group::class, 'group_ID', 'id');
    }
}
