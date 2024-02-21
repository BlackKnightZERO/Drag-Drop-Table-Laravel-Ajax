<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('tasks.create') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Add</a>
                </div>
            </div>
        </div>
    </div>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                
                <div class="flex flex-col">
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                        <div class="overflow-hidden">
                        <table class="min-w-full text-left text-sm font-light" id="table">
                            <thead class="border-b font-medium dark:border-neutral-500">
                            <tr>
                                <th scope="col" class="px-6 py-4">#</th>
                                <th scope="col" class="px-6 py-4">Task</th>
                                <th scope="col" class="px-6 py-4">Action</th>
                            </tr>
                            </thead>
                            <tbody id="tcontents">
                            @foreach ($tasks as $key => $task)    
                            <tr class="border-b dark:border-neutral-500 r1" data-id="{{ $task->id }}" style="cursor: pointer;">
                                <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $key+1 }}</td>
                                <td class="whitespace-nowrap px-6 py-4">{{ $task->title }}</td>
                                <td class="whitespace-nowrap px-6 py-4">                       
                                    <a href="{{ route('tasks.edit', $task->id) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Edit</a>                                    
                                    <br>
                                    <br>
                                    <form method="POST" action="{{ route('tasks.destroy', $task->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a href="route('tasks.destroy', $task->id)"
                                            class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                            {{ __('Delete') }}
                                        </a>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>

<script type="text/javascript">
$(function () {
    $("#table").DataTable({
        "paging":   false,
        "ordering": false,
        "info":     false,
        "searching": false
    });
    $( "#tcontents" ).sortable({
        items: "tr",
        cursor: 'move',
        opacity: 0.7,
        update: function() {
            reOrder();
        }
    });
function reOrder() {
    var order = [];
    var token = $('meta[name="csrf-token"]').attr('content');

    $('tr.r1').each(function(idx,elm) {
    order.push({
        id: $(this).attr('data-id'),
        position: idx+1
        });
    });

    $.ajax({
        type: "POST",
        dataType: "json",
        url: "{{ url('reorder') }}",
        data: {
            order: order,
            _token: token
    },
        success: function(res) {
            if (res.status == "success") {
                console.log(res);
            } else {
                console.log(res)
            }
        }
    });
}
});
</script>
