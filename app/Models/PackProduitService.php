<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PackProduitService
 * 
 * @property int $id_pack
 * @property int $id_produit
 * @property int|null $quantity
 * 
 * @property Pack $pack
 * @property ProduitsService $produits_service
 *
 * @package App\Models
 */
class PackProduitService extends Model
{
	protected $table = 'pack_produit_service';
	public $incrementing = false;
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'id_pack' => 'int',
		'id_produit' => 'int',
		'quantity' => 'int'
	];

	protected $fillable = [
		'quantity'
	];

	public function pack()
	{
		return $this->belongsTo(Pack::class, 'id_pack');
	}

	public function produits_service()
	{
		return $this->belongsTo(ProduitsService::class, 'id_produit');
	}
}
