<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Helpers\ModelHelper;

class Invoice extends Model
{
    use ModelHelper;

    protected $guarded=[];
}
