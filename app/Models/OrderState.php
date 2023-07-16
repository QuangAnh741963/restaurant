<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderState
 *
 * @property int $id
 * @property string $state
 *
 * @property Collection|Order[] $orders
 *
 * @package App\Models
 *
 * @mixin Builder
 */
class OrderState extends Model
{
	protected $table = 'order_states';
	public $timestamps = false;

	protected $fillable = [
		'state'
	];

	public function orders()
	{
		return $this->hasMany(Order::class, 'state_id');
	}
}
