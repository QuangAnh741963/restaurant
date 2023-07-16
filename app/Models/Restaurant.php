<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Restaurant
 *
 * @property int $id
 * @property string $name
 * @property string $tax_code
 * @property string $name_leader
 * @property string $address
 *
 * @package App\Models
 *
 * @mixin Builder
 */
class Restaurant extends Model
{
    use HasFactory;

	protected $table = 'restaurants';
	public $timestamps = false;

	protected $fillable = [
		'name',
		'tax_code',
		'name_leader',
		'address'
	];
}
