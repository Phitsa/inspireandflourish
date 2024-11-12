@extends('layouts.app')

@section('title', 'Home Page')

@section('links', 'rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/css/multi-select-tag.css"')

@php
    $members = [
      [
        'id'   => '1',
        'name' => 'Anthony Felipe',
      ],
      [
        'id'   => '2',
        'name' => 'Luis Eduardo',
      ],
      [
        'id'   => '3',
        'name' => 'Ana Luisa',
      ],
];
@endphp

@section('MainContent')

<section class="flex items-center p-8 justify-between">

  <h2 class="text-3xl font-semibold">Meetings</h2>
  
  <button id="openModalMeetings" class="bg-sky-500 rounded p-3 text-white">ADD Meeting</button>

</section>
<hr class="mx-8 border-1 border-black"/>

<section class="invisible fixed inset-0 flex flex-col justify-center items-center bg-gray-500 bg-opacity-50" id="registerMeetingForm">
  <form class="bg-white rounded-lg w-1/4 p-6 grid grid-cols-2" id="closeModalMeetings" action="registermeeting">

    <h1 class="text-2xl mb-4 col-span-2">Create Member</h1>
    
    <label for="meetingName" class="text-md col-span-2">Meeting Name</label>
    <input class="border-2 p-2 rounded-lg mb-4 col-span-2" type="text" name="meetingName" id="" placeholder="Meeting theme...">

    <label for="meetingDate" class="col-span-2">Meeting Date</label>
    <input class="border-2 rounded-lg p-2 mb-2 col-span-2" type="date" name="meetingDate" id="">

    <div class="col-span-2 mb-2">
      <label class="col-span-2" for="meetingMembers">Meeting Members</label>
      <select name="meetingMembers" id="membersSelect" class="rounded-lg border-2 col-span-2" multiple id="">
        @foreach ($members as $member)
            <option value="{{$member['id']}}">{{$member['name']}}</option>
        @endforeach
      </select>
    </div>

    <label class="col-span-2" for="meetingDescription">Description</label>
    <textarea class="col-span-2 border-2 mb-6 h-20 text-sm" name="meetingDescription" id=""></textarea>
    
    <div class="col-span-2 flex items-center justify-center">
      <input type="submit" value="Send" class="bg-sky-400 cursor-pointer text-white font-bold col-span-2 rounded-md p-2 w-24">
    </div>
  </form>
</section>

<script>

  const openModalMeetings = document.getElementById('openModalMeetings')
  const registerMeetingForm = document.getElementById('registerMeetingForm')


  openModalMeetings.addEventListener('click', function() {
    registerMeetingForm.style.visibility = 'visible';
  })

  registerMeetingForm.addEventListener('click', function(event) {
    if(event.target === registerMeetingForm) {
      document.getElementById('registerMeetingForm').style.visibility = 'hidden';
      editToggleTransition.classList.remove('after:transition-all');
    }
  });
</script>



<script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/js/multi-select-tag.js"></script>
<script>
  new MultiSelectTag('membersSelect', {
    placeholder: "Search",
    rounded: true,
    tagColor: {
        textColor: '#327b2c',
        borderColor: '#92e681',
        bgColor: '#eaffe6',
    },
  })
</script>
@endsection