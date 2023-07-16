<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderTablesDetail
 * 
 * @property int $id
 * @property string|null $order_id
 * @property string $table_id
 * 
 * @property Order|null $order
 * @property Table $table
 *
 * @package App\Models
 */
class OrderTablesDetail extends Model
{
	protected $table = 'order_tables_details';
	public $timestamps = false;

	protected $fillable = [
		'order_id',
		'table_id'
	];

	public function order()
	{
		return $this->belongsTo(Order::class);
	}

	public function table()
	{
		return $this->belongsTo(Table::class);
	}
}
