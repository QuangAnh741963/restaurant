<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Item
 *
 * @property int $id
 * @property string $name
 * @property int $price
 * @property string $unit
 *
 * @property Collection|Order[] $orders
 *
 * @package App\Models
 *
 * @mixin Builder
 */
class Item extends Model
{
	protected $table = 'items';
	public $timestamps = false;

	protected $casts = [
		'price' => 'int'
	];

	protected $fillable = [
		'name',
		'price',
		'unit'
	];

	public function orders(): BelongsToMany
    {
		return $this->belongsToMany(Order::class, 'order_items_details')
					->withPivot('quantity', 'id');
	}
}
