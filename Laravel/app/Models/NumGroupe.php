<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class NumGroupe
 *
 * @property int $id
 * @property int $filiere_id
 * @property int $a_affecter
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Filiere $filiere
 *
 * @package App\Models
 */
class NumGroupe extends Model
{
    use HasFactory;
	protected $table = 'num_groupes';

	protected $casts = [
		'filiere_id' => 'int',
		'a_affecter' => 'int'
	];

	protected $fillable = [
		'filiere_id',
		'a_affecter'
	];

	public function filiere()
	{
		return $this->belongsTo(Filiere::class);
	}
}
