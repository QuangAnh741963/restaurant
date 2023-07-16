<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderExtraItemsDetail
 * 
 * @property string $order_id
 * @property int $extra_item_id
 * @property int $quantity_start
 * @property int $quantity_not_use
 * @property int $id
 * 
 * @property ExtraItem $extra_item
 * @property Order $order
 *
 * @package App\Models
 */
class OrderExtraItemsDetail extends Model
{
	protected $table = 'order_extra_items_details';
	public $timestamps = false;

	protected $casts = [
		'extra_item_id' => 'int',
		'quantity_start' => 'int',
		'quantity_not_use' => 'int'
	];

	protected $fillable = [
		'order_id',
		'extra_item_id',
		'quantity_start',
		'quantity_not_use'
	];

	public function extra_item()
	{
		return $this->belongsTo(ExtraItem::class);
	}

	public function order()
	{
		return $this->belongsTo(Order::class);
	}
}
