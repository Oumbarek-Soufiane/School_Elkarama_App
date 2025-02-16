<?php



namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Groupe
 *
 * @property int $id
 * @property string $designation
 * @property int $filiere_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Filiere $filiere
 * @property Collection|Etudiant[] $etudiants
 * @property Collection|GroupeDetail[] $groupes_details
 *
 * @package App\Models
 */
class Groupe extends Model
{
    use HasFactory;

	protected $table = 'groupes';

	protected $casts = [
		'filiere_id' => 'int'
	];

	protected $fillable = [
		'designation',
		'filiere_id'
	];

	public function filiere()
	{
		return $this->belongsTo(Filiere::class);
	}

	public function etudiants()
	{
		return $this->hasMany(Etudiant::class);
	}

	public function groupe_details()
	{
		return $this->hasMany(GroupeDetail::class);
	}
}
