<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    public function index()
    {
        $teamMembers = Team::all();
        return view('admin.team_members.index', compact('teamMembers'));
    }

    public function create()
    {
        // Add logic for creating a team member form
    }

    public function store(Request $request)
    {
        // Add logic to store a new team member
    }

    public function show(Team $teamMember)
    {
        return view('admin.team_members.show', compact('teamMember'));
    }

    public function edit(Team $teamMember)
    {
        // Add logic for editing a team member form
    }

    public function update(Request $request, Team $teamMember)
    {
        // Add logic to update the team member
    }

    public function destroy(Team $teamMember)
    {
        // Add logic to delete the team member
    }
}
