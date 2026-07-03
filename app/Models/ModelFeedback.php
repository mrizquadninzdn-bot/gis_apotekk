<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelFeedback extends Model
{
    protected $table            = 'tbl_feedback';
    protected $primaryKey       = 'id_feedback';
    protected $allowedFields    = ['nama', 'email', 'kontak', 'pesan'];
}