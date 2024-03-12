<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Group extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'groups';
    protected $fillable = [ 'id', 'group_name', 'title', 'content'];

    /**
     * Get the products for the group.
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'group_ID', 'id');
    }
}
