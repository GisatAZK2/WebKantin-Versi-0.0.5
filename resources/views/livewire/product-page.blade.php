<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <section class="py-10 bg-gray-50 font-poppins dark:bg-gray-800 rounded-lg">
      <div class="px-4 py-4 mx-auto max-w-7xl lg:py-6 md:px-6">
          <div class="flex flex-wrap mb-24 -mx-3">
              <!-- Sidebar Categories -->
              <div class="w-full pr-2 lg:w-1/4 lg:block">
                  <div class="p-4 mb-5 bg-white border border-gray-200 dark:border-gray-900 dark:bg-gray-900">
                      <h2 class="text-2xl font-bold dark:text-gray-400">Categories</h2>
                      <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>
                      <ul>
                          @foreach ($kategoris as $kategori)
                              <li class="mb-4" wire:key="{{ $kategori->id }}">
                                  <label class="flex items-center dark:text-gray-400">
                                      <input 
                                          wire:model.live="selected_kategoris" 
                                          type="checkbox" 
                                          value="{{ $kategori->id }}" 
                                          class="w-4 h-4 mr-2"
                                      >
                                      <span class="text-lg">{{ $kategori->Nama_kategori }}</span>
                                  </label>
                              </li>
                          @endforeach
                      </ul>
                  </div>
              </div>
              <!-- Products Section -->
              <div class="w-full px-3 lg:w-3/4">
                  <div class="px-3 mb-4">
                      <div class="items-center justify-between hidden px-3 py-2 bg-gray-100 md:flex dark:bg-gray-900">
                          <input 
                              type="text" 
                              placeholder="Cari produk..." 
                              wire:model="search" 
                              wire:keydown.enter="performSearch"
                              class="block w-full px-3 py-2 text-base bg-white border border-gray-300 rounded-md dark:text-gray-400 dark:bg-gray-800 dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500"
                          />
                      </div>
                  </div>
                  <div class="flex flex-wrap items-center">
                      @foreach ($products as $product)
                          <div class="w-full px-3 mb-6 sm:w-1/2 md:w-1/3" wire:key="{{ $product->id }}">
                              <div class="border border-gray-300 dark:border-gray-700">
                                  <div class="relative bg-gray-200">
                                      <a href="/products/{{ $product->name }}">
                                          <img 
                                              src="{{ $product->getFirstMediaUrl('product_images') }}" 
                                              alt="{{ $product->name }}" 
                                              class="object-cover w-full h-56 mx-auto"
                                          >
                                      </a>
                                  </div>
                                  <div class="p-3">
                                      <h3 class="text-xl font-medium dark:text-gray-400">
                                          {{ $product->name }}
                                      </h3>
                                      <p class="text-lg text-green-600 dark:text-green-400">
                                          Rp{{ number_format($product->price_min, 0, ',', '.') }} - Rp{{ number_format($product->price_max, 0, ',', '.') }}
                                      </p>
                                  </div>
                                  <div class="flex justify-center p-4 border-t border-gray-300 dark:border-gray-700">
                                      <span>Stok: {{ $product->total_stock }}</span>
                                  </div>
                              </div>
                          </div>
                      @endforeach
                  </div>
                  <!-- Pagination -->
                  <div class="flex justify-end mt-6">
                      {{ $products->links() }}
                  </div>
              </div>
          </div>
      </div>
  </section>
</div>
