<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Customer
 *
 * @property int $id
 * @property string $name
 * @property string|null $phone
 * @property string|null $email
 *
 * @property Collection|Order[] $orders
 *
 * @package App\Models
 */
class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';
	public $timestamps = false;

	protected $fillable = [
		'name',
		'phone',
		'email'
	];

	public function orders(): HasMany
    {
		return $this->hasMany(Order::class);
	}
}
