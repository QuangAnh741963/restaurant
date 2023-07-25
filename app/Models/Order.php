<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Order
 *
 * @property string $id
 * @property int $state_id
 * @property Carbon $created_at
 * @property Carbon|null $modified_at
 * @property int $total_bill
 * @property int|null $customer_id
 * @property string $payment
 *
 * @property Customer|null $customer
 * @property OrderState $order_state
 * @property Collection|ExtraItem[] $extra_items
 * @property Collection|Item[] $items
 * @property Collection|Table[] $tables
 *
 * @package App\Models
 *
 * @mixin Builder
 */
class Order extends Model
{
	protected $table = 'orders';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'state_id' => 'int',
		'modified_at' => 'datetime',
		'total_bill' => 'int',
		'customer_id' => 'int'
	];

	protected $fillable = [
		'state_id',
		'modified_at',
		'total_bill',
		'customer_id',
		'payment'
	];

    protected $with = ['tables', 'items', 'extra_items', 'customer', 'order_state'];

	public function customer(): BelongsTo
    {
		return $this->belongsTo(Customer::class);
	}

	public function order_state(): BelongsTo
    {
		return $this->belongsTo(OrderState::class, 'state_id');
	}

	public function extra_items(): BelongsToMany
    {
		return $this->belongsToMany(ExtraItem::class, 'order_extra_items_details')
					->withPivot('quantity_start', 'quantity_not_use', 'id');
	}

	public function items(): BelongsToMany
    {
		return $this->belongsToMany(Item::class, 'order_items_details')
					->withPivot('quantity', 'id');
	}

	public function tables(): BelongsToMany
    {
		return $this->belongsToMany(Table::class, 'order_tables_details')
					->withPivot('id');
	}
}
