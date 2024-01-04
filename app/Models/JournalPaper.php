<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalPaper extends Model {
    protected $fillable = ['title', 'link', 'pdf_path', 'image_path', 'publication_date'];

    

    public function teams()
{
    return $this->belongsToMany(Team::class, 'journal_paper_team_member', 'journal_paper_id', 'team_member_id');
}
}