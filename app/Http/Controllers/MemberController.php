<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::paginate(10);
        $totalMembers = Member::count();
        $visitorsQuantity = Member::where('isVisitor', true)->count();
        $columns = ['nome','genero', 'visitante', 'data', 'ações'];
        $tableColumns = ['name', 'personGender', 'isVisitor', 'created_at', 'id'];
        return view('pages.members', compact('members', 'totalMembers', 'visitorsQuantity', 'columns', 'tableColumns'));
    }

    public function store()
    {

        $isVisitor = request()->has('isVisitor') ? 1 : 0;

        Member::create([
            'name' => request('name'),
            'isVisitor' => $isVisitor,
            'personGender' => request('personGender')
        ]);

        return redirect('members');
    }

    public function update()
    {
        $isVisitor = request()->has('editIsVisitor') ? 1 : 0;

        $member = Member::findOrFail(request('editId'));
        $member->name = request('editName');
        $member->personGender = request('editPersonGender');
        $member->isVisitor = $isVisitor;

        $member->save();
        return redirect('members');
    }

    public function delete()
    {
        $member = Member::findOrFail(request('deletedId'));
        $member->delete();
        return redirect('members');
    }
}
