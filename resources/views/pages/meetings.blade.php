@extends('layouts.app')

@section('title', 'Home Page')

@section('MainContent')

<section class="flex items-center p-8 justify-between">

  <h2 class="text-3xl font-semibold">Meetings</h2>

  <button modal-name="registerMeetingForm" class="bg-sky-500 rounded p-3 text-white" onclick="openModal(this)">ADD Meeting</button>
</section>
<hr class="mx-8 border-1 border-black"/>

<section class="flex flex-col h-full w-full overflow-auto justify-between">
  <div class="m-10">
    <ul class="flex text-gray-600">
      <li class="">
        Meetings Quantity: {{$totalMeetings}}
      </li>
    </ul>
  </div>
  <div class="grid grid-cols-4 grid-rows-2 flex-grow gap-4 mx-8 mb-10">
    @foreach ($meetings as $meeting)
      <div class="w-full h-full p-4 rounded-lg border border-gray-300 shadow-lg flex flex-col justify-between bg-white">
    <div class="mb-4">
        <h1 class="text-xl font-bold text-gray-800 mb-2">{{$meeting->meeting_name}}</h1>
        <p class="text-gray-600"><strong>Date:</strong> {{$meeting->meeting_date}}</p>

        @if ($meeting->description)
        <p class="text-gray-700 mt-2"><strong>Description:</strong> {{$meeting->description}}</p>
        @endif

        <h4 class="text-gray-800 font-semibold mt-4">Membros:</h4>
        <ul class="list-disc pl-6 mt-2 text-gray-600">
        @foreach ($meeting->members->take(4) as $member)
            <li>{{ $member->name }}</li>
        @endforeach
        </ul>
    </div>

    <div class="flex justify-end gap-3">
      <button data-meeting-members="
      @foreach ($meeting->members as $member)
          {{$member->name}},
      @endforeach"
      onclick="showMembers(this)"
      class="bg-teal-500 hover:bg-teal-600 w-24 py-2 rounded-md text-white font-medium transition duration-200 shadow-sm"
      >
      Members
      </button>

      <button
      class="bg-blue-500 hover:bg-blue-600 w-24 py-2 rounded-md text-white font-medium transition duration-200 shadow-sm"
      data-meeting-id="{{$meeting->id}}"
      data-meeting-name="{{$meeting->meeting_name}}"
      data-meeting-date="{{$meeting->meeting_date}}"
      data-meeting-desc="{{$meeting->description}}"
      onclick="openEditModal(this)"
      >
      Edit
      </button>

      <button
      class="deleteButton bg-red-500 hover:bg-red-600 w-24 py-2 rounded-md text-white font-medium transition duration-200 shadow-sm"
      flash="{{$meeting->id}}"
      modal-name="deleteMeetingModal"
      onclick="openModal(this)"
      >
      Remove
      </button>
      </div>
      </div>

      @endforeach
      <div class="col-span-4">
      {{ $meetings->links() }}
    </div>
  </div>



</section>

<section class="invisible fixed inset-0 flex flex-col justify-center items-center bg-gray-500 bg-opacity-50" id="registerMeetingForm" onclick="closeModal(this)">
  <form class="bg-white rounded-md w-1/4 p-6 grid grid-cols-2" id="closeModalMeetings" method="POST" action="meetings/save" autocomplete="off" onclick="event.stopPropagation()">
    @csrf
    <div class="col-span-2 flex justify-between items-center mb-4">
      <h1 class="text-2xl">Add Meeting</h1>
      <button onclick="closesvg(this)">
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

<section class="invisible fixed inset-0 flex flex-col justify-center items-center bg-gray-500 bg-opacity-50" id="editMeetingForm" onclick="closeModal(this)">
  <form class="bg-white rounded-md w-1/4 p-6 grid grid-cols-2" id="closeEditModalMeetings" method="POST" action="meetings/update" autocomplete="off" onclick="event.stopPropagation()">
    @csrf
    @method('PUT')
    <div class="col-span-2 flex justify-between items-center mb-4">
      <h1 class="text-2xl">Edit Meeting</h1>
      <button type="button" onclick="closesvg(this)">
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

<section class="invisible fixed inset-0 flex flex-col justify-center items-center bg-gray-500 bg-opacity-50" id="showMembersModal" onclick="closeModal(this)">
	<div class="bg-white rounded-md p-4" onclick="event.stopPropagation()">
		<div class="col-span-2 flex justify-between gap-8 items-center mb-4">
			<h1 class="text-2xl">Meeting Members</h1>
			<button onclick="closesvg(this)">
				<svg xmlns="http://www.w3.org/2000/svg" id="closeMeetingModal" class="size-6 cursor-pointer" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#0EA5E9" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>
			</button>
		</div>
		<div>
			<ol class="list-inside list-decimal" id="membersList">

			</ol>
		</div>
	</div>
</section>

<section class="invisible fixed inset-0 flex flex-col justify-center items-center bg-gray-500 bg-opacity-50" id="deleteMeetingModal" onclick="closeModal(this)">
  <form method="POST" class="bg-white rounded-md p-4 w-1/4" onclick="event.stopPropagation()" action="meeting/delete">
    @csrf
    @method('DELETE')

    <input type="hidden" name="flash" value="">

    <div class="col-span-2 flex justify-between gap-8 items-center mb-4">
      <h1 class="text-2xl">Delete Meeting?</h1>
      <button type="button" onclick="closesvg(this)">
          <svg xmlns="http://www.w3.org/2000/svg" id="closeMeetingModal" class="size-6 cursor-pointer" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#0EA5E9" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>
      </button>
    </div>
    <div>
      <p id="deleteModelTitle" class="text-gray-600 mb-3">This action cannot be undone. Once confirmed, all data for this meeting will be permanently deleted.</p>
    </div>
    <div class="flex justify-center">
      <input
      type="submit"
      value="Delete"
      class="bg-red-500 text-white border w-20 rounded cursor-pointer py-2 px-1 transition duration-300 ease-in-out hover:scale-105 focus:bg-red-600 focus:outline-none focus:ring focus:ring-red-300"
      />
    </div>
  </form>
</section>

<script>

  function openModal(button) {
    const modalId = button.getAttribute('modal-name');
    const modalName = document.getElementById(modalId);
    const flash = button.getAttribute('flash');

    document.querySelector('input[name="flash"]').value = flash;
    modalName.style.visibility = 'visible';
  }

  function closesvg(button) {
    const grandparent = button.parentElement.parentElement;
    grandparent.parentElement.style.visibility = 'hidden';
  }

  function closeModal(modal) {
    modal.style.visibility = 'hidden';
  }

  function openDeleteModal(button) {
    const id = button.getAttribute('data-meeting-id');
    const name = button.getAttribute('data-meeting-name');
    const date = button.getAttribute('data-meeting-date');
    const desc = button.getAttribute('data-meeting-desc');
  }

  function openEditModal(button) {
    const id = button.getAttribute('data-meeting-id');
    const name = button.getAttribute('data-meeting-name');
    const date = button.getAttribute('data-meeting-date');
    const desc = button.getAttribute('data-meeting-desc');

    document.querySelector('input[name="meetingEditId"]').value = id;
    document.querySelector('input[name="meetingEditName"]').value = name;
    document.querySelector('input[name="meetingEditDate"]').value = date;
    document.querySelector('textarea[name="meetingEditDesc"]').value = desc;

    document.getElementById('editMeetingForm').style.visibility = 'visible';
  }

  function showMembers(button) {

  const members = button.getAttribute('data-meeting-members');
  const memberList = members.split(',').map(member => member.trim()).filter(member => member !== '');
  const showMembersModal = document.getElementById('showMembersModal');
  const membersContainer = document.getElementById('membersList');

  membersContainer.innerHTML = '';

  memberList.forEach(function(member) {
      const listItem = document.createElement('li');
      listItem.textContent = member.trim();
      membersContainer.appendChild(listItem);
  });

  showMembersModal.style.visibility = 'visible';
  }

</script>

@endsection
