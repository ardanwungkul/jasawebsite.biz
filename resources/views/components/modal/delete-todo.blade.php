<div id="deleteTodo" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-800 border-white border">
            <form action="{{ route('todo.postDone') }}" method="POST" id="myForm">
                @method('POST')
                @csrf
                <div
                    class="flex items-start justify-between p-2 border-b dark:border-white bg-blue-900 dark:bg-gray-600 rounded-t-lg">
                    <h3 class="text-xl font-semibold text-white">
                        Submit Semua Todo Yang Sudah Selesai ?
                    </h3>
                    <button type="button" id="btn-hide-active"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="deleteTodo">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class=" p-3">
                    <div id="cek1">
                        <ul id="subjectTodo" class="space-y-2">
                        </ul>
                    </div>
                </div>

                <div
                    class="flex items-center px-6 py-3 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-white dark:hover:bg-blue-700 dark:focus:ring-blue-800 dark:text-black w-full">
                        Submit</button>
                </div>
            </form>
            <!-- Modal header -->
        </div>
    </div>
</div>
<script>
    document.getElementById('myForm').addEventListener('submit', function(event) {
        var checkboxes = document.querySelectorAll('input[type=checkbox]:checked');
        if (checkboxes.length < 1) {
            event.preventDefault();
            alert('Pilih setidaknya satu opsi!');
        }
    });
</script>
