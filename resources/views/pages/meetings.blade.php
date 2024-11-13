@extends('layouts.app')

@section('title', 'Home Page')

@section('MainContent')

<section class="flex items-center p-8 justify-between">

  <h2 class="text-3xl font-semibold">Meetings</h2>

  <button id="openModalMeetings" class="bg-sky-500 rounded p-3 text-white">ADD Meeting</button>
</section>
<hr class="mx-8 border-1 border-black"/>

<section class="h-full w-full overflow-x-auto">
  <div class="relative grid grid-cols-5 grid-rows-3 gap-4 h-fit p-8">
    @foreach ($meetings as $meeting)
      <div class="w-full h-full p-2 rounded-lg border-4 flex flex-col justify-between">
        <div>
          <h1 class="font-bold">{{$meeting->meeting_name}}</h1>
          <p><strong>Date:</strong> {{$meeting->meeting_date}}</p>
          @if ($meeting->description)
            <h2><strong>Description:</strong> {{$meeting->description}}</h2>
          @endif
        </div>
        <div class="py-2 flex justify-end gap-2">
          <button
          class="editButton bg-blue-500 hover:bg-blue-600 w-20 p-2 rounded-md text-white transition duration-200"
          data-meeting-id="{{$meeting->id}}"
          data-meeting-name="{{$meeting->meeting_name}}"
          data-meeting-date="{{$meeting->meeting_date}}"
          data-meeting-desc="{{$meeting->description}}"
          >Edit</button>
          <button
          class="deleteButton bg-red-500 hover:bg-red-600 w-20 p-2 rounded-md text-white transition duration-200"
          data-meeting-id="{{$meeting->id}}"
          data-meeting-name="{{$meeting->meeting_name}}"
          data-meeting-date="{{$meeting->meeting_date}}"
          data-meeting-desc="{{$meeting->description}}"
          >Remove</button>
        </div>
      </div>
    @endforeach
  </div>

  <div class="mx-8 mb-10 bg-gray-200">
    {{ $meetings->links() }}
  </div>

</section>

<section class="invisible fixed inset-0 flex flex-col justify-center items-center bg-gray-500 bg-opacity-50" id="registerMeetingForm">
  <form class="bg-white rounded-lg w-1/4 p-6 grid grid-cols-2" id="closeModalMeetings" method="POST" action="meetings/save" autocomplete="off">
    @csrf
    <div class="col-span-2 flex justify-between items-center mb-4">
      <h1 class="text-2xl">Add Meeting</h1>
      <button  onclick="closesvg()">
        <svg xmlns="http://www.w3.org/2000/svg" id="closeMeetingModal" class="size-6 cursor-pointer" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#0EA5E9" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>
      </button>
    </div>

    <label for="meetingName" class="text-md col-span-2">Meeting Name</label>
    <input class="border-2 p-2 rounded-lg mb-4 col-span-2" type="text" name="meetingName" id="" placeholder="Meeting theme..." required maxlength="30">

    <label for="meetingDate" class="col-span-2">Meeting Date</label>
    <input class="border-2 rounded-lg p-2 mb-2 col-span-2" type="date" name="meetingDate" id="" required>

    <div class="col-span-2 mb-2">
      <label class="col-span-2" for="meetingMembers">Meeting Members</label>
      <select name="meetingMembers[]" id="membersSelect" class="rounded-lg border-2 col-span-2" multiple id="" required>
        @foreach ($members as $member)
            <option value="{{$member->id}}">{{$member->name}}</option>
        @endforeach
      </select>
    </div>

    <label class="col-span-2" for="meetingDescription">Description</label>
    <textarea class="col-span-2 border-2 mb-6 h-20 text-sm resize-none rounded-md" name="meetingDescription" id=""></textarea>

    <div class="col-span-2 flex items-center justify-center">
      <input type="submit" value="Send" class="bg-sky-400 cursor-pointer text-white font-bold col-span-2 rounded-md p-2 w-24">
    </div>
  </form>
</section>

<section class="invisible fixed inset-0 flex flex-col justify-center items-center bg-gray-500 bg-opacity-50" id="editMeetingForm">
  <form class="bg-white rounded-lg w-1/4 p-6 grid grid-cols-2" id="closeEditModalMeetings" method="POST" action="meetings/update" autocomplete="off">
    @csrf
    @method('PUT')
    <div class="col-span-2 flex justify-between items-center mb-4">
      <h1 class="text-2xl">Edit Meeting</h1>
      <button  onclick="closeeditsvg()">
        <svg xmlns="http://www.w3.org/2000/svg" id="closeMeetingModal" class="size-6 cursor-pointer" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#0EA5E9" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>
      </button>
    </div>

    <input type="hidden" name="meetingEditId">

    <label for="meetingName" class="text-md col-span-2">Meeting Name</label>
    <input class="border-2 p-2 rounded-lg mb-4 col-span-2" type="text" name="meetingEditName" id="meetingName" placeholder="Meeting theme..." required maxlength="30">

    <label for="meetingDate" class="col-span-2">Meeting Date</label>
    <input class="border-2 rounded-lg p-2 mb-2 col-span-2" type="date" name="meetingEditDate" id="meetingDate" required>

    <div class="col-span-2 mb-2">
      <label class="col-span-2" for="meetingMembers">Meeting Members</label>
      @if ($errors->has('meetingMembers'))
        <div class="text-red-500 text-sm">
            {{ $errors->first('meetingMembers') }}
        </div>
      @endif
      <select name="meetingMembers[]" id="membersEditSelect" class="rounded-lg border-2 col-span-2" multiple id="" required>
        @foreach ($members as $member)
            <option value="{{$member->id}}">{{$member->name}}</option>
        @endforeach
      </select>
    </div>

    <label class="col-span-2" for="meetingDescription">Description</label>
    <textarea class="col-span-2 border-2 mb-6 h-20 text-sm resize-none rounded-md" name="meetingEditDesc" id="meetingEditDesc"></textarea>

    <div class="col-span-2 flex items-center justify-center">
      <input type="submit" value="Save" class="bg-sky-400 cursor-pointer text-white font-bold col-span-2 rounded-md p-2 w-24">
    </div>
  </form>
</section>

{{-- <dialog open id="errorDialog" class="inset-0 h-fit w-80 bg-red-600 text-white p-4 rounded-md flex flex-col">
  <div class="flex justify-between mb-2 items-center">
    <p id="errorMessage" class="text-center text-lg">A error ocurred</p>
    <svg xmlns="http://www.w3.org/2000/svg" id="closeMeetingModal" class="size-6 cursor-pointer" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#0EA5E9" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>
  </div>
  <p class="col-span-2">{{Error}}</p>
</dialog> --}}

<script>

  const openModalMeetings = document.getElementById('openModalMeetings')
  const registerMeetingForm = document.getElementById('registerMeetingForm')
  const closeMeetingModal = document.getElementById('closeMeetingModal')

  const closeEditModalMeetings = document.getElementById('closeEditModalMeetings')
  const editMeetingForm = document.getElementById('editMeetingForm')
  const closeSvgMeetingModal = document.getElementById('closeSvgMeetingModal')

  openModalMeetings.addEventListener('click', function() {
    registerMeetingForm.style.visibility = 'visible';
  })

  registerMeetingForm.addEventListener('click', function(event) {
    if(event.target === registerMeetingForm) {
      registerMeetingForm.style.visibility = 'hidden';
    }
  });

  document.querySelectorAll('.editButton').forEach(button => {
    button.addEventListener('click', function() {
      const id = this.getAttribute('data-meeting-id');
      const name = this.getAttribute('data-meeting-name');
      const date = this.getAttribute('data-meeting-date');
      const desc = this.getAttribute('data-meeting-desc');

      document.querySelector('input[name="meetingEditId"]').value = id;
      document.querySelector('input[name="meetingEditName"]').value = name;
      document.querySelector('input[name="meetingEditDate"]').value = date;
      document.querySelector('textarea[name="meetingEditDesc"]').value = desc;

      document.getElementById('editMeetingForm').style.visibility = 'visible';
    });
  });

  editMeetingForm.addEventListener('click', function(event) {
    if(event.target === editMeetingForm) {
      editMeetingForm.style.visibility = 'hidden';
    }
  });

  function closesvg() {
    registerMeetingForm.style.visibility = 'hidden';
  }

  function closeeditsvg() {
    editMeetingForm.style.visibility = 'hidden';
  }

</script>

@endsection
