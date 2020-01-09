<?php

namespace MitaJunior\Workflow\Models;

use Illuminate\Database\Eloquent\Model;

class Action extends Model {

    protected $table = 'm_actions';

    protected $guarded = [];

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }

    public function next_stage()
    {
        return $this->belongsTo(Stage::class, 'next_stage_id');
    }
}