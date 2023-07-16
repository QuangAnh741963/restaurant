<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Table
 *
 * @property string $id
 * @property int $quantity
 * @property string $state
 *
 * @property Collection|Order[] $orders
 *
 * @package App\Models
 *
 * @mixin Builder
 */
class Table extends Model
{
    use HasFactory;

	protected $table = 'tables';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'quantity' => 'int'
	];

	protected $fillable = [
		'quantity',
		'state'
	];

	public function orders(): BelongsToMany
    {
		return $this->belongsToMany(Order::class, 'order_tables_details')
					->withPivot('id');
	}
}
