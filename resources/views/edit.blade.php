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
                    {{ __("Edit Task") }}
                </div>
            </div>
        </div>
    </div>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('tasks.update', $task->id) }}">
                    @method('PUT')
                    @csrf
            
                    <div>
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input 
                        id="id" class="block mt-1 w-full" type="hidden" name="id" 
                        :value="old('id', $task->id)" required />
                        <x-text-input 
                        id="title" class="block mt-1 w-full" type="text" name="title" 
                        :value="old('title', $task->title)" required />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <x-primary-button class="mt-3">
                        {{ __('Submit') }}
                    </x-primary-button>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>