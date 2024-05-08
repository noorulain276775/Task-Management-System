@extends('layouts.app')
@section('content')
    <div class="flex flex-col text-gray-700 bg-gradient-to-tr from-blue-200 via-indigo-200 to-pink-200 overflow-x-hidden">
        <div class="px-6 mt-6">
            <h1 class="text-2xl font-bold">Task Management System</h1>
        </div>
        <div class="flex flex-grow px-10 mt-4">
            <div class="flex flex-col col-4">
                <div class="flex items-center flex-shrink-0 h-10 px-2">
                    <span class="block text-sm font-semibold">Pending</span>
                    <span
                        class="flex items-center justify-center w-5 h-5 ml-2 text-sm font-semibold text-indigo-500 bg-white rounded bg-opacity-30">{{ $pendingCount }}</span>
                    <a class="openCreateTaskModal flex items-center justify-center w-6 h-6 ml-auto text-indigo-500 rounded hover:bg-indigo-500 hover:text-indigo-100"
                        data-task_status="pending" data-user_id="{{ $tasks->first()->user_id }}" href="">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </a>
                </div>
                @foreach ($tasks as $task)
                    @if ($task->task_statuses->name == 'pending')
                        <div class="flex flex-col pb-2">
                            <div class="relative flex flex-col items-start p-4 mt-3 bg-white rounded-lg cursor-pointer bg-opacity-90 group hover:bg-opacity-100"
                                draggable="true">
                                <a class="dropdownToggle absolute top-0 right-0 flex items-center justify-center hidden w-5 h-5 mt-3 mr-2 text-gray-500 rounded hover:bg-gray-200 hover:text-gray-700 group-hover:flex"
                                    data-task_id="{{ $task->id }}" data-task_title="{{ $task->title }}"
                                    data-task_description="{{ $task->description }}">
                                    <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                    </svg>
                                </a>
                                <div
                                    class="dropdownMenu hidden absolute right-0 mt-2 w-32 bg-white border rounded-md shadow-lg z-10">
                                    <a href="#"
                                        class="block px-4 py-2 text-gray-800 hover:bg-gray-200 dropdown-option">Edit</a>
                                    <a href="#"
                                        class="block px-4 py-2 text-gray-800 hover:bg-gray-200 dropdown-option">Delete</a>
                                </div>
                                <span
                                    class="flex items-center h-6 px-3 text-xs font-semibold text-pink-500 bg-pink-100 rounded-full">{{ $task->title }}</span>
                                <h4 class="mt-3 text-sm font-medium">{{ $task->description }}</h4>
                                <div class="flex items-center w-full mt-3 text-xs font-medium text-gray-400">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-gray-300 fill-current" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="ml-1 leading-none">{{ $task->created_at }}</span>
                                    </div>
                                    <div class="relative flex items-center ml-4">
                                        <svg class="relative w-4 h-4 text-gray-300 fill-current"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="ml-1 leading-none">{{ $task->user->name }}</span>
                                    </div>
                                    {{-- <div class="flex items-center ml-4">
                                        <svg class="w-4 h-4 text-gray-300 fill-current" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="ml-1 leading-none">1</span>
                                    </div>
                                    <img class="w-6 h-6 ml-auto rounded-full"
                                        src='https://randomuser.me/api/portraits/women/26.jpg' /> --}}
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="flex flex-col col-4">
                <div class="flex items-center flex-shrink-0 h-10 px-2">
                    <span class="block text-sm font-semibold">On-Going</span>
                    <span
                        class="flex items-center justify-center w-5 h-5 ml-2 text-sm font-semibold text-indigo-500 bg-white rounded bg-opacity-30">{{ $ongoingCount }}</span>
                    <a class="openCreateTaskModal flex items-center justify-center w-6 h-6 ml-auto text-indigo-500 rounded hover:bg-indigo-500 hover:text-indigo-100"
                        data-task_status="on-going" data-user_id="{{ $tasks->first()->user_id }}" href="">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </a>
                </div>
                @foreach ($tasks as $task)
                    @if ($task->task_statuses->name == 'on-going')
                        <div class="flex flex-col pb-2">
                            <div class="relative flex flex-col items-start p-4 mt-3 bg-white rounded-lg cursor-pointer bg-opacity-90 group hover:bg-opacity-100"
                                draggable="true">

                                <a class="dropdownToggle absolute top-0 right-0 flex items-center justify-center hidden w-5 h-5 mt-3 mr-2 text-gray-500 rounded hover:bg-gray-200 hover:text-gray-700 group-hover:flex"
                                    data-task_id="{{ $task->id }}" data-task_title="{{ $task->title }}"
                                    data-task_description="{{ $task->description }}">
                                    <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                    </svg>
                                </a>
                                <div
                                    class="dropdownMenu hidden absolute right-0 mt-2 w-32 bg-white border rounded-md shadow-lg z-10">
                                    <a href="#"
                                        class="block px-4 py-2 text-gray-800 hover:bg-gray-200 dropdown-option">Edit</a>
                                    <a href="#"
                                        class="block px-4 py-2 text-gray-800 hover:bg-gray-200 dropdown-option">Delete</a>
                                </div>

                                <span
                                    class="flex items-center h-6 px-3 text-xs font-semibold text-pink-500 bg-pink-100 rounded-full">{{ $task->title }}</span>
                                <h4 class="mt-3 text-sm font-medium">{{ $task->description }}</h4>
                                <div class="flex items-center w-full mt-3 text-xs font-medium text-gray-400">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-gray-300 fill-current" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="ml-1 leading-none">{{ $task->created_at }}</span>
                                    </div>
                                    <div class="relative flex items-center ml-4">
                                        <svg class="relative w-4 h-4 text-gray-300 fill-current"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="ml-1 leading-none">{{ $task->user->name }}</span>
                                    </div>
                                    {{-- <div class="flex items-center ml-4">
                                        <svg class="w-4 h-4 text-gray-300 fill-current" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="ml-1 leading-none">1</span>
                                    </div> --}}
                                    {{-- <img class="w-6 h-6 ml-auto rounded-full"
                                        src='https://randomuser.me/api/portraits/women/26.jpg' /> --}}
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="flex flex-col col-4">
                <div class="flex items-center flex-shrink-0 h-10 px-2">
                    <span class="block text-sm font-semibold">Done</span>
                    <span
                        class="flex items-center justify-center w-5 h-5 ml-2 text-sm font-semibold text-indigo-500 bg-white rounded bg-opacity-30">{{ $doneCount }}</span>
                    <a class="openCreateTaskModal flex items-center justify-center w-6 h-6 ml-auto text-indigo-500 rounded hover:bg-indigo-500 hover:text-indigo-100"
                        data-task_status="done" data-user_id="{{ $tasks->first()->user_id }}" href="">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </a>
                </div>
                @foreach ($tasks as $task)
                    @if ($task->task_statuses->name == 'done')
                        <div class="flex flex-col pb-2">
                            <div class="relative flex flex-col items-start p-4 mt-3 bg-white rounded-lg cursor-pointer bg-opacity-90 group hover:bg-opacity-100"
                                draggable="true">
                                <a class="dropdownToggle absolute top-0 right-0 flex items-center justify-center hidden w-5 h-5 mt-3 mr-2 text-gray-500 rounded hover:bg-gray-200 hover:text-gray-700 group-hover:flex"
                                    data-task_id="{{ $task->id }}" data-task_title="{{ $task->title }}"
                                    data-task_description="{{ $task->description }}">
                                    <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                    </svg>
                                </a>
                                <div
                                    class="hidden dropdownMenu absolute right-0 mt-2 w-32 bg-white border rounded-md shadow-lg z-10">
                                    <a href="#"
                                        class="block px-4 py-2 text-gray-800 hover:bg-gray-200 dropdown-option">Edit</a>
                                    <a href="#"
                                        class="block px-4 py-2 text-gray-800 hover:bg-gray-200 dropdown-option">Delete</a>
                                </div>
                                <span
                                    class="flex items-center h-6 px-3 text-xs font-semibold text-pink-500 bg-pink-100 rounded-full">{{ $task->title }}</span>
                                <h4 class="mt-3 text-sm font-medium">{{ $task->description }}</h4>
                                <div class="flex items-center w-full mt-3 text-xs font-medium text-gray-400">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-gray-300 fill-current" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="ml-1 leading-none">{{ $task->created_at }}</span>
                                    </div>
                                    <div class="relative flex items-center ml-4">
                                        <svg class="relative w-4 h-4 text-gray-300 fill-current"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="ml-1 leading-none">{{ $task->user->name }}</span>
                                    </div>
                                    {{-- <div class="flex items-center ml-4">
                                        <svg class="w-4 h-4 text-gray-300 fill-current" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div> --}}
                                    {{-- <img class="w-6 h-6 ml-auto rounded-full"
                                        src='https://randomuser.me/api/portraits/women/26.jpg' /> --}}
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>


    <div class="modal fade" id="createTaskModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createTaskForm" action="{{ route('create.task') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="user_id" value="" id="user_id" />
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="taskStatus">Task Status</label>
                            <select class="form-control" id="taskStatus" name="task_status_id">
                                <option value="1">Pending</option>
                                <option value="3">Done</option>
                                <option value="2">On-going</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" style="border: none">Save Task</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- @section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.1/css/dataTables.dataTables.css" />
@endsection --}}

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    <script>
        $('.openCreateTaskModal').on('click', function(e) {
            e.preventDefault();
            var task_status = $(this).data('task_status');
            var user_id = $(this).data('user_id')
            console.log(user_id)
            var value_Status;

            if (task_status == "pending") {
                value_Status = 1;
            }
            if (task_status == "on-going") {
                value_Status = 2;
            }
            if (task_status == "done") {
                value_Status = 3;
            }
            $('#taskStatus').val(value_Status);
            $('#user_id').val(user_id);
            console.log(user_id)
            $('#createTaskModal').modal('show');
        });


        document.addEventListener('DOMContentLoaded', function() {
            var dropdownMenus = document.querySelectorAll('.dropdownMenu');
            var dropdownToggles = document.querySelectorAll('.dropdownToggle');

            dropdownToggles.forEach(function(toggle, index) {
                toggle.addEventListener('click', function() {
                    dropdownMenus[index].classList.toggle('hidden');
                });
            });

            // Close dropdown when an option is selected
            var dropdownOptions = document.querySelectorAll('.dropdown-option');
            dropdownOptions.forEach(function(option) {
                option.addEventListener('click', function() {
                    dropdownMenus.forEach(function(menu) {
                        menu.classList.add('hidden');
                    });
                });
            });

            // Close dropdown when clicking anywhere outside the dropdown
            document.addEventListener('click', function(event) {
                dropdownToggles.forEach(function(toggle, index) {
                    var isClickInside = toggle.contains(event.target) || dropdownMenus[index]
                        .contains(event.target);
                    if (!isClickInside) {
                        dropdownMenus[index].classList.add('hidden');
                    }
                });
            });
        });
    </script>
@endsection
