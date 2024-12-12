<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('product', () => ({
            mainImage: '{{ $products->variants->first()->getFirstMediaUrl('variant_images') ?: 'https://via.placeholder.com/150' }}',
            price: {{ $products->variants->first()->price }},

            updateImage(event) {
                const selectedOption = event.target.selectedOptions[0];
                this.mainImage = selectedOption.getAttribute('data-image');
            },

            validateQuantity() {
                if (this.quantity < 1) {
                    this.quantity = 1;
                }
            },
        }));
    });
</script>



<div x-data="product" class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <section class="overflow-hidden bg-white py-11 font-poppins dark:bg-gray-800">
        <div class="max-w-6xl px-4 py-4 mx-auto lg:py-8 md:px-6">
            <div class="flex flex-wrap -mx-4">
                <div class="w-full mb-8 md:w-1/2 md:mb-0">
                    <div class="sticky top-0 z-10 overflow-hidden bg-white">
                        <div class="relative mb-6 lg:mb-10 lg:h-2/4">
                            <img 
                                x-bind:src="mainImage" 
                                alt="Main Product Image" 
                                class="w-full h-auto lg:h-full rounded-lg shadow-lg">
                        </div>
                        <div class="flex-wrap hidden md:flex">
                            @foreach($products->getMedia('product_images') as $image)
                                <div class="w-1/2 p-2 sm:w-1/4" x-on:click="mainImage='{{ $image->getUrl() }}'">
                                    <img 
                                        src="{{ $image->getUrl() }}" 
                                        alt="Product Image" 
                                        class="w-full h-20 lg:h-40 cursor-pointer rounded-lg hover:border-2 hover:border-blue-500">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                                <!-- Product Details -->
                <div class="w-full px-4 md:w-1/2">
                    <div class="lg:pl-20">
                        <div class="mb-8">
                            <h2 class="max-w-xl mb-6 text-2xl font-bold dark:text-gray-400 md:text-4xl">
                                {{ $products->name }}
                            </h2>
                            <p class="inline-block mb-6 text-4xl font-bold text-gray-700 dark:text-gray-400">
                                <span x-text="new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(price)"></span>
                            </p>
                            <p class="max-w-md text-gray-700 dark:text-gray-400">
                            {{ $products->description}}
                            </p>
                        </div>

                        <!-- Variants -->
                        <div class="mt-8">
                            <label for="variants" class="block mb-2 text-lg font-semibold text-gray-700 dark:text-gray-400">Varian</label>
                            <div class="grid grid-cols-2 gap-4">
                                @foreach($products->variants as $variant)
                                    <button
                                        class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium border rounded-md cursor-pointer dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 hover:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                        x-on:click="mainImage='{{ $variant->getFirstMediaUrl('variant_images') ?: 'https://via.placeholder.com/150' }}'; price={{ $variant->price }}; selectedVariant='{{ $variant->id }}'">
                                        <img 
                                            src="{{ $variant->getFirstMediaUrl('variant_images', 'thumb') ?: 'https://via.placeholder.com/50' }}" 
                                            alt="{{ $variant->name }}" 
                                            class="w-12 h-12 mr-2 rounded-md">
                                        <span>{{ $variant->name }}</span>
                                    </button>
                                @endforeach
                            </div>
                        </div>
                        <br>

                        <!-- Add to Cart -->
                        <div class="flex flex-wrap items-center gap-4">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

        
        </div>
    </div>
</div>
