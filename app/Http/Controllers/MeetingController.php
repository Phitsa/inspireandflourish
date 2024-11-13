<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Member;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    public function index()
    {
        $members  = Member::all();
        $meetings = Meeting::paginate(10);
        return view('pages.meetings', compact('members', 'meetings'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'meetingName' => 'required|string|max:255',
                'meetingDate' => 'required|date|date_format:Y-m-d',
                'meetingDescription'  => 'nullable|string|max:500',

            ]);

            $meeting = Meeting::Create([
                'meeting_name' => request('meetingName'),
                'meeting_date' => request('meetingDate'),
                'description'  => request('meetingDescription'),
            ]);

            $memberIds = request('meetingMembers');

            $meeting->members()->attach($memberIds);

            return redirect('meetings')->with('success', 'Reunião criada com sucesso!');
        } catch (\Exception $exeption) {
            return redirect('meetings')->with('error', 'Erro ao criar a reunião. Tente novamente!');
        }
    }

    public function update(Request $request)
    {

        $validatedData = $request->validate([
            'meetingEditName' => 'required|string|max:255',
            'meetingEditDate' => 'required|date|date_format:Y-m-d',
            'meetingEditDesc' => 'nullable|string|max:500',
            'meetingMembers'  => 'required|array',
        ]);

        $meeting = Meeting::findOrFail(request('meetingEditId'));

        $meeting->meeting_name = request('meetingEditName');
        $meeting->meeting_date = request('meetingEditDate');
        $meeting->description  = request('meetingEditDesc');
        $meeting->save();


        $meeting->members()->sync($validatedData['meetingMembers']);
        return redirect('meetings');

    }
}
