<?php



namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Invite
 *
 * @property int $id
 * @property string $nom
 * @property string $prenom
 * @property string $email
 * @property Carbon $dateNaissance
 * @property float $moyenneDernierAnnee
 * @property int|null $numeroTelephone
 * @property string $niveauScolaire
 * @property string|null $photo
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Invite extends Model
{
    use HasFactory;

	protected $table = 'invites';

	protected $fillable = [
		'nom',
		'prenom',
		'email',
		'dateNaissance',
		'numeroTelephone',
		'genre',
		'situationFamiliale',
		'moyenneDernierAnnee',
		'filiereActuelle',
		'couvertureMedicale',
		'filiere_id',
		'photo'
	];

    protected $casts = [
		'dateNaissance' => 'date',
		'numeroTelephone' => 'string'
	];


    public function filiere()
	{
		return $this->belongsTo(Filiere::class);
	}

}
