<x-layouts::app :title="'Editar produto'">

    <div class="mx-auto max-w-2xl">

        <h1 class="mb-6 text-2xl font-semibold">
            Editar produto
        </h1>


        <form
            method="POST"
            action="{{ route('establishments.products.update', [$establishment, $product]) }}"
            enctype="multipart/form-data"
            class="flex flex-col gap-6"
        >
            @csrf
            @method('PUT')


            {{-- Nome --}}
            <flux:input
                name="name"
                label="Nome"
                :value="old('name', $product->name)"
                required
                autofocus
            />


            {{-- Categoria --}}
            <div>

                <label
                    for="category_id"
                    class="mb-2 block text-sm font-medium"
                >
                    Categoria
                </label>

                <select
                    id="category_id"
                    name="category_id"
                    required
                    class="w-full rounded-lg border border-zinc-300 px-3 py-2"
                >
                    @foreach ($categories as $category)

                        <option
                            value="{{ $category->id }}"
                            @selected(old('category_id', $product->category_id) == $category->id)
                        >
                            {{ $category->name }}
                        </option>

                    @endforeach
                </select>

                @error('category_id')

                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            {{-- Descrição --}}
            <flux:textarea
                name="description"
                label="Descrição"
            >{{ old('description', $product->description) }}</flux:textarea>


            {{-- Foto atual --}}
            <div>

                <label class="mb-2 block text-sm font-medium">
                    Foto do produto
                </label>

                @if ($product->image_path)

                    <div class="mb-4 overflow-hidden rounded-xl border border-zinc-200 dark:border-zinc-700">

                        <img
                            src="{{ asset('storage/' . $product->image_path) }}"
                            alt="{{ $product->name }}"
                            class="h-56 w-full object-cover"
                        >

                    </div>

                @else

                    <div class="mb-4 flex h-40 items-center justify-center rounded-xl border border-dashed border-zinc-300 bg-zinc-50 text-sm text-zinc-400 dark:border-zinc-700 dark:bg-zinc-900">
                        Este produto ainda não possui uma foto.
                    </div>

                @endif


                {{-- Nova foto --}}
                <input
                    id="image"
                    type="file"
                    name="image"
                    accept="image/jpeg,image/png,image/webp"
                    class="block w-full rounded-lg border border-zinc-300 bg-white px-3 py-2 text-sm
                           file:mr-4 file:rounded-md file:border-0 file:bg-zinc-100
                           file:px-3 file:py-2 file:text-sm file:font-medium
                           hover:file:bg-zinc-200
                           dark:border-zinc-700 dark:bg-zinc-900
                           dark:file:bg-zinc-800"
                >

                <p class="mt-1 text-xs text-zinc-500">
                    Selecione uma nova foto para substituir a atual.
                    JPG, PNG ou WebP. Máximo de 2 MB.
                </p>

                @error('image')

                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            {{-- Preço --}}
            <flux:input
                name="price"
                label="Preço"
                type="number"
                step="0.01"
                min="0"
                :value="old('price', $product->price)"
                required
            />


            {{-- Status --}}
            <label class="flex items-center gap-2">

                <input
                    type="checkbox"
                    name="active"
                    value="1"
                    @checked(old('active', $product->active))
                    class="rounded"
                >

                <span class="text-sm">
                    Produto ativo
                </span>

            </label>


            {{-- Botões --}}
            <div class="flex gap-3">

                <flux:button
                    type="submit"
                    variant="primary"
                >
                    Salvar alterações
                </flux:button>

                <flux:button
                    href="{{ route('establishments.products.index', $establishment) }}"
                >
                    Cancelar
                </flux:button>

            </div>

        </form>

    </div>

</x-layouts::app>