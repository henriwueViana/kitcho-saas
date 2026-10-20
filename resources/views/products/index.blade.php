<x-layouts::app :title="'Produtos'">

    <div class="flex flex-col gap-8">

        {{-- Cabeçalho --}}
        <div class="flex items-center justify-between">

            <div>
                <h1 class="text-2xl font-semibold">
                    Produtos
                </h1>

                <p class="text-sm text-zinc-600 dark:text-zinc-400">
                    {{ $establishment->name }}
                </p>
            </div>

            <a
                href="{{ route('establishments.products.create', $establishment) }}"
                class="rounded-lg bg-black px-4 py-2 text-sm font-medium text-white transition hover:bg-zinc-800 dark:bg-white dark:text-black dark:hover:bg-zinc-200"
            >
                Novo produto
            </a>

        </div>


        {{-- Mensagem de sucesso --}}
        @if (session('success'))

            <div class="rounded-lg bg-green-100 px-4 py-3 text-sm text-green-800">
                {{ session('success') }}
            </div>

        @endif


        {{-- Nenhum produto --}}
        @if ($products->isEmpty())

            <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">

                <p class="text-zinc-600 dark:text-zinc-400">
                    Nenhum produto cadastrado.
                </p>

            </div>

        @else

            {{-- Produtos agrupados por categoria --}}
            @foreach ($products->groupBy('category_id') as $categoryProducts)

                @php
                    $category = $categoryProducts->first()->category;
                @endphp


                <section class="flex flex-col gap-4">

                    {{-- Cabeçalho da categoria --}}
                    <div class="flex items-center justify-between">

                        <div>

                            <h2 class="text-lg font-semibold">
                                {{ $category->name }}
                            </h2>

                            <p class="text-sm text-zinc-500 dark:text-zinc-400">

                                {{ $categoryProducts->count() }}

                                {{ $categoryProducts->count() === 1 ? 'produto' : 'produtos' }}

                            </p>

                        </div>


                        <a
                            href="{{ route('establishments.products.create', $establishment) }}?category_id={{ $category->id }}"
                            class="rounded-lg border border-zinc-200 bg-white px-3 py-2 text-sm font-medium transition hover:bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900 dark:hover:bg-zinc-800"
                        >
                            + Novo
                        </a>

                    </div>


                    {{-- Cards dos produtos --}}
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">

                        @foreach ($categoryProducts as $product)

                            <div
                                class="flex flex-col overflow-hidden rounded-xl border border-zinc-200 bg-white transition hover:-translate-y-0.5 hover:shadow-md dark:border-zinc-700 dark:bg-zinc-900"
                            >

                                {{-- Foto do produto --}}
                                <div class="aspect-[4/3] w-full overflow-hidden bg-zinc-100 dark:bg-zinc-800">

                                    @if ($product->image_path)

                                        <img
                                            src="{{ asset('storage/' . $product->image_path) }}"
                                            alt="{{ $product->name }}"
                                            class="h-full w-full object-cover"
                                        >

                                    @else

                                        <div class="flex h-full items-center justify-center text-sm text-zinc-400">
                                            Sem imagem
                                        </div>

                                    @endif

                                </div>


                                {{-- Conteúdo do card --}}
                                <div class="flex min-h-48 flex-col p-5">

                                    {{-- Nome e status --}}
                                    <div class="flex items-start justify-between gap-3">

                                        <h3 class="font-semibold">
                                            {{ $product->name }}
                                        </h3>


                                        @if ($product->active)

                                            <span class="shrink-0 rounded-full bg-green-100 px-2 py-1 text-xs font-medium text-green-700">
                                                Ativo
                                            </span>

                                        @else

                                            <span class="shrink-0 rounded-full bg-zinc-100 px-2 py-1 text-xs font-medium text-zinc-500">
                                                Inativo
                                            </span>

                                        @endif

                                    </div>


                                    {{-- Descrição --}}
                                    @if ($product->description)

                                        <p class="mt-3 line-clamp-3 text-sm text-zinc-500 dark:text-zinc-400">
                                            {{ $product->description }}
                                        </p>

                                    @else

                                        <p class="mt-3 text-sm italic text-zinc-400">
                                            Sem descrição
                                        </p>

                                    @endif


                                    {{-- Parte inferior --}}
                                    <div class="mt-auto pt-5">

                                        {{-- Preço --}}
                                        <div class="flex items-center justify-between">

                                            <span class="text-lg font-semibold">
                                                R$
                                                {{ number_format($product->price, 2, ',', '.') }}
                                            </span>

                                        </div>


                                        {{-- Ações --}}
                                        <div class="mt-4 flex items-center gap-3 border-t border-zinc-100 pt-3 dark:border-zinc-800">

                                            <a
                                                href="{{ route('establishments.products.edit', [$establishment, $product]) }}"
                                                class="text-sm font-medium text-blue-600 hover:underline"
                                            >
                                                Editar
                                            </a>


                                            <form
                                                method="POST"
                                                action="{{ route('establishments.products.destroy', [$establishment, $product]) }}"
                                            >

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="text-sm font-medium text-red-600 hover:underline"
                                                    onclick="return confirm('Deseja excluir este produto?')"
                                                >
                                                    Excluir
                                                </button>

                                            </form>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        @endforeach

                    </div>

                </section>

            @endforeach

        @endif

    </div>

</x-layouts::app>