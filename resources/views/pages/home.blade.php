@extends('layouts.app')

@section('title', 'Home Page')

@section('MainContent')

<section class="flex items-center p-8 justify-between">

  <h2 class="text-3xl font-semibold">Home</h2>

  <button modal-name="registerMeetingForm" class="bg-sky-500 rounded p-3 text-white" onclick="openModal(this)">Get Info</button>
</section>
<hr class="mx-8 border-1 border-black"/>

<section class="h-full w-full grid grid-cols-3 gap-2 p-8">

  <div class="shadow-lg border h-full rounded">
    some info about the growth of the GP here
  </div>

  <div class="shadow-lg border h-full rounded">
    some info about the meetings here, like dates and places where it is being made
  </div>

  <div class="shadow-lg border h-full rounded">
    info about the members of the GP here
  </div>

  <div class="shadow-lg border col-span-3 h-full rounded">
    a overall info? maybe?
  </div>

</section>
@endsection
