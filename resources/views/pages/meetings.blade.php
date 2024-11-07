@extends('layouts.app')

@section('title', 'Home Page')

@section('links', 'rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/css/multi-select-tag.css"')



@section('MainContent')

<section class="flex items-center p-8 justify-between">

  <h2 class="text-3xl font-semibold">Meetings</h2>
  
  <button id="openModalMeetings" class="bg-sky-500 rounded p-3 text-white">ADD Meeting</button>

</section>
<hr class="mx-8 border-1 border-black"/>

<section>
  <form id="registerMeetingForm" action="registermeeting">

    <input type="text" name="meetingName" id="">

  </form>
</section>

<script>

</script>
@endsection