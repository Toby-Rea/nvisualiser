<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Models the Dataset data structure
 *
 * @property int $id
 * @property string $description
 * @property string $data_url
 * @property int $start_year
 * @property int $end_year
 * @property boolean $downloaded
 */
class Dataset extends Model
{
  public $timestamps = false;
}
