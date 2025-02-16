<?php



namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 *
 * @property int $id
 * @property string $nom
 * @property string $prenom
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string $role
 * @property Carbon $dateNaissance
 * @property int|null $numeroTelephone
 * @property string $genre
 * @property string $situationFamiliale
 * @property string|null $photo
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|Admin[] $admins
 * @property Collection|Etudiant[] $etudiants
 * @property Collection|Tuteur[] $tuteurs
 * @property Collection|Professeur[] $professeurs
 *
 * @package App\Models
 */
class User extends Authenticatable
{
	use HasApiTokens,HasFactory,Notifiable;

	protected $table = 'users';

	protected $casts = [
		'email_verified_at' => 'datetime',
		'dateNaissance' => 'date',
		'numeroTelephone' => 'string'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'nom',
		'prenom',
		'email',
		'email_verified_at',
		'password',
		'role',
		'dateNaissance',
		'numeroTelephone',
		'genre',
		'situationFamiliale',
		'photo',
		'remember_token'
	];

	public function admin()
	{
		return $this->hasOne(Admin::class);
	}

	public function etudiant()
	{
		return $this->hasOne(Etudiant::class);
	}

	public function tuteur()
	{
		return $this->hasOne(Tuteur::class);
	}

	public function professeur()
	{
		return $this->hasOne(Professeur::class);
	}
}
