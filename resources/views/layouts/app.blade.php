<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  @yield('links')
  <title>@yield('title')</title>
</head>
<body class="h-screen flex ">
  <nav class="h-full w-48 bg-sky-600">
    <h1 class="h-1/6 text-3xl text-white text-center flex font-semibold items-center">
        Inspire and Flourish
    </h1>
    <ul class="text-white">
      <li class="m-2">
        <a
        href="/"
        @class([
        'p-2 block w-full rounded-md hover:bg-sky-500',
        'bg-sky-500' => request()->is('/')
        ])>Home</a>
      </li>
      <li class="m-2">
        <a
        href="/meetings"
        @class([
        'p-2 block w-full rounded-md hover:bg-sky-500',
        'bg-sky-500' => request()->is("meetings")
        ])
        >Meetings</a>
      </li>
      <li class="m-2">
        <a
        href="/members"
        @class([
        'p-2 block w-full rounded-md hover:bg-sky-500',
        'bg-sky-500' => request()->is('members', 'member/*/edit')
        ])>Members</a>
      </li>
    </ul>
  </nav>

  <main class="w-full flex flex-col">
    @yield('MainContent')
  </main>
</body>
</html>
