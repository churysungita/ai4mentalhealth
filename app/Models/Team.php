<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $fillable = [
        'image_path',
        'member_name',
        'member_position',
        'facebook',
        'twitter',
        'instagram',
        'linkedin',
    ];

    public function conferencePapers()
    {
        return $this->belongsToMany(ConferencePaper::class, 'conference_paper_team_member');
    }
}