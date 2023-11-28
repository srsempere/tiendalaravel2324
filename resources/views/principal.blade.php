<x-app-layout>
    <div class="flex">
        <div class="p-2 flex-1 grid grid-cols-3 gap-4 justify-center justify-items-center">
            @foreach ($articulos as $articulo)
                <a href="#"
                    class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                        {{ $articulo->denominacion }}</h5>
                    <p class="font-normal text-gray-700 dark:text-gray-400">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Accusantium aspernatur rem fuga similique et porro amet voluptatem asperiores, molestiae veritatis voluptatum ipsum, ipsam, magni possimus repellendus in quam quod suscipit.</p>
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>
