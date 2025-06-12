<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tag
 * 
 * @property int $id
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Collection|Article[] $articles
 *
 * @package App\Models
 */
class Tag extends Model
{
	protected $table = 'tags';

	protected $fillable = [
		'name'
	];

	public function articles()
	{
		return $this->belongsToMany(Article::class);
	}
}
