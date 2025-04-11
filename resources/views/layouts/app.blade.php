<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  @vite('resources/js/registerMember.js')
  @yield('links')
  <title>@yield('title')</title>
</head>
<body class="h-screen flex ">
  <nav class="h-full w-48 bg-purple-950">
    <div class="flex flex-col items-center justify-center h-32">
        <h1 class="text-4xl text-white text-center font-semibold">
            Phitsa
        </h1>
    </div>

    <ul class="text-white">
      <li class="m-2">
        <a
        href="/"
        @class([
        'p-2 block w-full rounded-md hover:bg-purple-500',
        'bg-purple-500' => request()->is('/')
        ])>Home</a>
      </li>
      <li class="m-2">
        <a
        href="/meetings"
        @class([
        'p-2 block w-full rounded-md hover:bg-purple-500',
        'bg-purple-500' => request()->is("meetings")
        ])
        >Meetings</a>
      </li>
      <li class="m-2">
        <a
        href="/members"
        @class([
        'p-2 block w-full rounded-md hover:bg-purple-500',
        'bg-purple-500' => request()->is('members', 'member/*/edit')
        ])>Members</a>
      </li>
    </ul>
  </nav>

  <main class="w-full flex flex-col">
    @yield('MainContent')
  </main>
</body>
</html>
