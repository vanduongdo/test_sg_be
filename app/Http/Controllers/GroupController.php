<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    //
    public function index()
    {
        $groups = Group::all();
        return $groups;
    }

    public function show(Request $request)
    {
        $group = Group::findOrFail($request->id);
        return $group;
    }      

    public function store(Request $request)
    {
        $request->validate([
            'group_name' => 'required',
            'title' => 'required',
            'content' => 'required'
        ]);
        $group = new Group;
        $group->group_name = $request->group_name;
        $group->title = $request->title;
        $group->content = $request->content;
        $group->save();

        return response()->json(['message' => 'Group created successfully', 'group' => $group], 201);
    }

    public function update(Request $request)
    {
        $request->validate([
            'group_name' => 'required',
            'title' => 'required',
            'content' => 'required'
        ]);
        $group = Group::findOrFail($request->id);

        $group->group_name = $request->group_name;
        $group->title = $request->title;
        $group->content = $request->content;
        $group->update();

        return response()->json(['message' => 'Group edit successfully', 'group' => $group], 200);
    }

    public function destroy(Request $request)
    {
        Group::findOrFail($request->id)->delete();

        return response()->json(['message' => 'Group deleted'], 200);
    }
}
