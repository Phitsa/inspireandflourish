<dialog id="{{ $dialogName }}">
  <form method="post" action="savemember" class="bg-white w-[400px] h-[500px] p-6 rounded shadow-lg">
      @csrf
      <div class="w-full flex justify-between items-center mb-8">
        <h2 class="text-2xl text-gray-700">
          New Member
        </h2>
          <svg xmlns="http://www.w3.org/2000/svg" id="closePopup" class="size-6 cursor-pointer" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#A855F7" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>
      </div>

      <div>
        <label for="name">Full Name</label>
        <input name="name" type="text" class="w-full p-2 mt-1 border border-gray-300 rounded" required placeholder="Anthony Felipe...">
      </div>

      <div class="flex justify-between items-center my-2">
        <select name="personGender" class="w-1/2 p-2 border border-gray-300 rounded" required>
          <option value="" disabled selected>Select gender</option>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
        </select>

        <label class="inline-flex items-center cursor-pointer my-2">
          <input type="checkbox" value="" name="isVisitor" class="sr-only peer ">
          <div id="toggleTransition" class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
          <span class="ms-3 text-sm font-medium text-gray-900">Is a Visitor?</span>
        </label>
      </div>

      <div class="flex justify-center">
        <input
        type="submit"
        value="Save"
        class="bg-purple-500 text-white border w-20 rounded cursor-pointer py-2 px-1"
        />
    </div>

    </form>
</dialog>
