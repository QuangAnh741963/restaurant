<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderItemsDetail
 * 
 * @property string $order_id
 * @property int $item_id
 * @property int $quantity
 * @property int $id
 * 
 * @property Item $item
 * @property Order $order
 *
 * @package App\Models
 */
class OrderItemsDetail extends Model
{
	protected $table = 'order_items_details';
	public $timestamps = false;

	protected $casts = [
		'item_id' => 'int',
		'quantity' => 'int'
	];

	protected $fillable = [
		'order_id',
		'item_id',
		'quantity'
	];

	public function item()
	{
		return $this->belongsTo(Item::class);
	}

	public function order()
	{
		return $this->belongsTo(Order::class);
	}
}
