<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Devoir
 *
 * @property int $id
 * @property int $tp_id
 * @property int $etudiant_id
 * @property string $reponses
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Etudiant $etudiant
 * @property Tp $tp
 *
 * @package App\Models
 */
class Devoir extends Model
{
    use HasFactory;

	protected $table = 'devoirs';

	protected $casts = [
		'tp_id' => 'int',
		'etudiant_id' => 'int'
	];

	protected $fillable = [
		'tp_id',
		'etudiant_id',
		'reponses'
	];

	public function etudiant()
	{
		return $this->belongsTo(Etudiant::class);
	}

	public function tp()
	{
		return $this->belongsTo(Tp::class);
	}
}
