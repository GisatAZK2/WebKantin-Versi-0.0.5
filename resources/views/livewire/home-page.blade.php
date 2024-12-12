<div>
  @if ($banner)
  <div
  class="w-full h-screen bg-gradient-to-r from-orange-200 to-cyan-200 py-10 px-4 sm:px-6 lg:px-8 mx-auto"
  style="
    background-image: url('{{ $banner->getFirstMediaUrl('default') }}');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
  "
  >
      <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Grid -->
         
        <!-- End Grid -->
      </div>
    </div>
  @else
    <p class="text-center text-gray-500">Tidak ada banner untuk ditampilkan.</p>
  @endif

  <div class="bg-[#A5D6A7] py-20">
    <div class="max-w-xl mx-auto text-center">
      <div class="relative flex flex-col items-center">
        <h1 class="text-5xl font-bold dark:text-gray-200">
          Browse <span class="text-lime-900">Categories</span>
        </h1>
        <div class="flex w-40 mt-2 mb-6 overflow-hidden rounded">
          <div class="flex-1 h-2 bg-stone-700"></div>
          <div class="flex-1 h-2 bg-lime-600"></div>
          <div class="flex-1 h-2 bg-rose-900"></div>
        </div>
        <p class="mb-12 text-base text-center text-black">
          Sangat Menggoda Sekali 🤤 Coba Di tekan
        </p>
      </div>
    </div>

    <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto">
      <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-6">
        @foreach ($kategoris as $kategori)
        <a
  class="group flex flex-col bg-white border shadow-sm rounded-full hover:shadow-md transition dark:bg-slate-900 dark:border-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
  href="/products?selected_kategoris[]={{ $kategori->id }}"
>
  <div class="p-4 md:p-5">
    <div class="flex justify-between items-center">
      <div class="flex items-center">
        <img
          class="h-[2.375rem] w-[2.375rem] rounded-full"
          src="{{ $kategori->getFirstMediaUrl('default') }}"
          alt="{{ $kategori->Nama_kategori }}"
        />
        <div class="ms-3">
          <h3
            class="group-hover:text-blue-600 font-semibold text-gray-800 dark:group-hover:text-gray-400 dark:text-gray-200"
          >
            {{ $kategori->Nama_kategori }}
          </h3>
        </div>
      </div>
      <div class="ps-3">
        <svg
          class="flex-shrink-0 w-5 h-5"
          xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
        >
          <path d="m9 18 6-6-6-6" />
        </svg>
      </div>
    </div>
  </div>
</a>

        @endforeach
      </div>
    </div>

    
  </div>
  <div>
<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <div class="px-4 py-4 mx-auto max-w-7xl lg:py-6 md:px-6">
  <div class="text-center mb-8">
    <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-200">
      Menu Rekomendasi
    </h1>
    <br>
    <div class="flex flex-wrap items-center ">
    @foreach ($products as $product)
    <div class="w-full px-3 mb-6 sm:w-1/2 md:w-1/3">
        <div class="border border-white dark:border-gray-700">
            <div class="relative bg-white">
                <a href="/products/{{ $product->name }}" class="">
                    <img src="{{ $product->getFirstMediaUrl('product_images') }}" alt="{{ $product->name }}" class="object-cover w-full h-56 mx-auto">
                </a>
            </div>
            <div class="p-3">
                <div class="flex items-center justify-between gap-2 mb-2">
                    <h3 class="text-xl font-medium dark:text-gray-400">
                        {{ $product->name }}
                    </h3>
                </div>
                <p class="text-lg">
                    <span class="text-green-600 dark:text-green-600">
                        Rp{{ number_format($product->price_min, 0, ',', '.') }} - Rp{{ number_format($product->price_max, 0, ',', '.') }}
                    </span>
                </p>
            </div>
            <div class="flex justify-center p-4 border-t border-gray-300 dark:border-gray-700">
                  <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path>
                   <span>Stok: {{ $product->total_stock }}</span>
            </div>
        </div>
    </div>
@endforeach
</div>



</div>


</div>
