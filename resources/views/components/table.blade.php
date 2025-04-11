<section class="w-full h-full overflow-x-auto">
    <div class="w-full px-8">
        <table class="w-full border-collapse mb-4 table-fixed rounded-md shadow-lg">
            <thead>
                <tr class="text-left bg-gray-200 border-b-2 border-gray-300">
                    @foreach ($columns as $column)
                        <th class="px-4 py-2 font-semibold">{{Str::ucfirst($column)}}</th>
                    @endforeach
                </tr>
            </thead>

            <tbody class="text-gray-600">
                @if (count($datas) == 0)
                    <tr>
                        <td colspan="{{ count($columns) }}" class="text-center py-4">No data available</td>
                    </tr>
                @else
                    @foreach ($datas as $index => $data)
                        <tr class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-50' }} transition duration-300 ease-in-out hover:bg-gray-200">
                            @foreach ($tableColumns as $columns)
                                @if ($columns == 'created_at')
                                    <td class="py-2 px-4">{{ \Carbon\Carbon::parse($data[$columns])->format('d/m/Y') }}</td>
                                @elseif ($columns == 'id')
                                    <td class="py-2 px-4">
                                        <button class="deleteButton bg-red-500 hover:bg-red-800 w-20 p-2 rounded-md text-white transition duration-200"
                                        @foreach ($datas as $data)
                                            @foreach ($tableColumns as $columns)
                                                data-{{$columns}}="{{$data[$columns]}}"
                                            @endforeach
                                        @endforeach
                                        >Delete</button>
                                        <button class="editButton bg-blue-500 hover:bg-blue-800 w-20 p-2 rounded-md text-white transition duration-200"
                                        @foreach ($datas as $data)
                                            @foreach ($tableColumns as $columns)
                                                data-{{$columns}}="{{$data[$columns]}}"
                                            @endforeach
                                        @endforeach
                                        >Edit</button>
                                    </td>

                                @else
                                    <td class="py-2 px-4">{{ $data[$columns] }}</td>
                                @endif

                            @endforeach
                        </tr>
                    @endforeach
                @endif


            </tbody>
        </table>
    </div>

    <div class="mx-8 mb-2">
        {{ $datas->links() }}
    </div>
</section>
