<?php

    use function Laravel\Folio\{middleware, name};
    use Livewire\Volt\Component;
    use Livewire\Attributes\Rule;
    use Livewire\Attributes\Computed;
    name('todos');

    new class extends Component
    {
        public $todos;

        #[Rule('required')]
        public $todo;

        public function mount()
        {
            $this->todos = [
                ['todo' => 'Install Wave Application', 'completed' => true,],
                ['todo' => 'Read the documentation', 'completed' => false,],
                ['todo' => 'Learn how to use folio and volt', 'completed' => false,],
                ['todo' => 'Add the todos single-file volt component', 'completed' => false,],
                ['todo' => 'See how simple Wave will make your life', 'completed' => false,]
            ];
        }

        public function add()
        {
            $this->validate();

            $this->todos[] = [
                'todo' => $this->todo,
                'completed' => false,
            ];

            $this->reset('todo');
        }

        #[Computed]
        public function remaining()
        {
            return collect($this->todos)->where('completed', false)->count();
        }
    }
?>

<x-layouts.marketing>
    @volt('todos')
    <div class="flex items-center justify-center w-full h-full px-16 py-20 text-neutral-300 bg-neutral-100">
        <div class="p-10 bg-white rounded">
            <h2 class="text-base font-semibold leading-7 text-neutral-900">My Todo</h2>
            <p class="mt-1 text-sm leading-6 text-neutral-500">You have {{ $this->remaining }} things on your todo list.
            </p>

            <div class="mt-4 space-y-3">
                @foreach($todos as $todo)
                <div class="relative flex items-start">
                    <div class="flex items-center h-6">
                        <input id="todo-{{ $loop->index }}" wire:model.live="todos.{{ $loop->index }}.completed"
                            type="checkbox" value="1"
                            class="w-4 h-4 text-indigo-600 rounded border-neutral-300 focus:ring-indigo-600">
                    </div>
                    <div class="ml-3 text-sm leading-6">
                        <label for="todo-{{ $loop->index }}" class="font-medium text-neutral-900">{{ $todo['todo']
                            }}</label>
                    </div>
                </div>
                @endforeach
            </div>

            <form wire:submit="add" class="mt-6">
                <input type="text" wire:model="todo" placeholder="My new todo..."
                    class="block py-1.5 w-full text-neutral-900 rounded-md border-0 ring-1 ring-inset ring-neutral-300 shadow-sm placeholder:text-neutral-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </form>
        </div>
    </div>
    @endvolt
</x-layouts.marketing>
