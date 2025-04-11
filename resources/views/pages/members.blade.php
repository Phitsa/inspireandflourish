@extends('layouts.app')
@section('title', 'Home Page')
@section('MainContent')

<section class="static flex items-center p-8 justify-between">

  <h2 class="text-3xl font-semibold">Members</h2>
  <button id="openRegisterPopup" class="bg-purple-500 rounded p-3 text-white">ADD Member</button>

</section>
<hr class="mx-8 border-1 border-black"/>
<div class="mx-8">
    <ul class="flex py-4 text-gray-600">
        <li class="pr-8">
            Members quantity: {{$totalMembers}}
        </li>
        <li>
            Visitors quantity: {{$visitorsQuantity}}
        </li>
    </ul>
</div>
<x-table
    :columns="$columns"
    :tableColumns="$tableColumns"
    :datas="$members"
/>
{{-- Members table Section --}}
{{-- <x-members-table
  :members="$members"
  :totalMembers="$totalMembers"
  :visitorsQuantity="$visitorsQuantity"
/> --}}

{{-- Popup de registro --}}

<x-register-member dialogName="RegisterMemberDialog" method="POST" action="savemember"/>

{{-- Popup de edição --}}
<section id="EditMemberForm" class="invisible fixed inset-0 flex justify-center items-center bg-gray-500 bg-opacity-50">
  <form method="post" action="member/update" class="bg-white w-[400px] h-[500px] p-6 rounded shadow-lg">
    @csrf
    @method('PUT')
    <div class="w-full flex justify-between items-center mb-8">
      <h2 class="text-2xl text-gray-700">
          Edit Member
      </h2>
      <svg xmlns="http://www.w3.org/2000/svg" id="closeModal" class="size-6 cursor-pointer" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#0EA5E9" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>
    </div>

    <input type="hidden" name="editId" value="">

    <div>
      <label for="name">Full Name</label>
      <input name="editName" type="text" class="w-full p-2 mt-1 border border-gray-300 rounded" required placeholder="Anthony Felipe...">
    </div>


    <div class="flex justify-between items-center my-2">
      <select name="editPersonGender" class="w-1/2 p-2 border border-gray-300 rounded" required>
        <option value="" disabled>Select gender</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
      </select>

      <label class="inline-flex items-center cursor-pointer my-2">
        <input type="checkbox" value="" name="editIsVisitor" class="sr-only peer ">
        <div id="editToggleTransition" class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
        <span class="ms-3 text-sm font-medium text-gray-900">Is a Visitor?</span>
      </label>
    </div>



    <div class="flex justify-center">
      <input
      type="submit"
      value="Save"
      class="bg-sky-500 text-white border w-20 rounded cursor-pointer py-2 px-1"
      />
  </div>

  </form>
</section>

<section id="DeleteMemberForm" class="invisible fixed inset-0 flex justify-center items-center bg-gray-500 bg-opacity-50">
  <form method="post" action="member/delete" class="bg-white w-[450px] p-6 rounded shadow-lg grid items-center">
    @csrf
    @method('DELETE')
    <div class="w-full flex justify-between items-center mb-2">
      <h2 class="text-2xl text-gray-700">
          Delete Member?
      </h2>
      <svg xmlns="http://www.w3.org/2000/svg" id="closeDeleteModal" class="size-6 cursor-pointer" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free C
        opyright 2024 Fonticons, Inc.--><path fill="#0EA5E9" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6
         9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>
    </div>
    <p id="deleteModelTitle" class="text-gray-600 mb-3">This action cannot be undone. Once confirmed, all data for [Member's Name] will be permanently deleted.</p>

    <input type="hidden" name="deletedId" value="">

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
    const closePopup = document.getElementById('closePopup');
    const modal = document.getElementById("RegisterMemberDialog");
    const openPopup = document.getElementById('openPopup');

  const RegisterMemberDialog = document.getElementById('RegisterMemberDialog');
  const toggleTransition     = document.getElementById('toggleTransition');
  const EditMemberForm       = document.getElementById('EditMemberForm');
  const editToggleTransition = document.getElementById('editToggleTransition');

  document.querySelectorAll('.editButton').forEach(button => {
    button.addEventListener('click', function() {
      const id = this.getAttribute('data-id')
      const name = this.getAttribute('data-name');
      const personGender = this.getAttribute('data-personGender');
      const isVisitor = this.getAttribute('data-isVisitor');

      document.querySelector('input[name="editId"]').value = id
      document.querySelector('input[name="editName"]').value = name;
      document.querySelector('select[name="editPersonGender"]').value = personGender;
      document.querySelector('input[name="editIsVisitor"]').checked = isVisitor === "1";

      document.getElementById('EditMemberForm').style.visibility = 'visible';
    });
  });


  document.querySelectorAll('.deleteButton').forEach(button => {
    button.addEventListener('click', function() {
      const memberName = this.getAttribute('data-name');
      const memberId = this.getAttribute('data-id');

      document.getElementById('DeleteMemberForm').style.visibility = 'visible';

      document.querySelector('input[name="deletedId"]').value = memberId;

      document.getElementById('deleteModelTitle').textContent = `This action cannot be undone. Once confirmed, all data for ${memberName} will be permanently deleted.`;
    });
  });

  document.getElementById('closeModal').addEventListener('click', function() {
      document.getElementById('EditMemberForm').style.visibility = 'hidden';
      editToggleTransition.classList.remove('after:transition-all');
  });

  document.getElementById('closeDeleteModal').addEventListener('click', function() {
      document.getElementById('DeleteMemberForm').style.visibility = 'hidden';
  });

  document.getElementById('EditMemberForm').addEventListener('click', function(event) {
    if (event.target === EditMemberForm) {
      EditMemberForm.style.visibility = 'hidden';
      editToggleTransition.classList.remove('after:transition-all');
    }
  })

</script>

@endsection
