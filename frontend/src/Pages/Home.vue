<template>
    <div class="w-full flex justify-center flex-col items-center space-y-4">
        <router-link to="/new-product"
            class="text-white bg-[#1b2440] hover:bg-[#141720] font-medium rounded-lg text-sm px-4 py-2 mb-2 w-full text-center">
            New Product
        </router-link>
        <!-- Search input -->
        <input v-model="filters.searchQuery" type="search" id="default-search"
            class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50"
            placeholder="Search Mockups, Logos..." required />

        <!-- Filter by category -->
        <select v-model="filters.category" class="mt-2 mb-2 p-2 border border-gray-300 rounded-lg">
            <option value="">All Categories</option>
            <option v-for="category in categories" :key="category.id" :value="category.name">{{ category.name }}
            </option>
        </select>

        <!-- Sort options -->
        <div class="flex flex-col md:flex-row space-x-2">
            <label>Sort By:</label>
            <select v-model="filters.sortField" class="p-2 border border-gray-300 rounded-lg">
                <option value="name">Name</option>
                <option value="price">Price</option>
            </select>

            <label>Order:</label>
            <select v-model="filters.sortOrder" class="p-2 border border-gray-300 rounded-lg">
                <option value="asc">Ascending</option>
                <option value="desc">Descending</option>
            </select>
        </div>

        <!-- Display filtered and sorted products -->
        <div v-if="!isLoading" class="grid grid-cols-2 md:grid-cols-4 w-full gap-5">
            <div v-for="product in filteredProducts" :key="product.id"
                class="mx-auto mt-11 transform overflow-hidden rounded-lg bg-white shadow-md duration-300 hover:scale-105 hover:shadow-lg">
                <img class="h-48 w-full object-fit object-center" :src="'http://'+product.image"
                    :alt="`Product Image - ${product.name}`" />
                <div class="p-4">
                    <h2 class="mb-2 text-lg font-medium text-gray-900">{{ product.name }}</h2>
                    <p class="mb-2 text-base text-gray-700">{{ product.description }}</p>

                    <div class="flex items-center">
                        <p class="mr-2 text-lg font-semibold text-gray-900">{{ `$${product.price.toFixed(2)}` }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div v-else>
            <div class="">
                <div role="status">
                    <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                    </svg>
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import {
        ref,
        computed,
        onMounted
    } from 'vue';
    import axios from 'axios';
    const isLoading = ref(true);
    let products = ref([]);
    let categories = ref([]);

    onMounted(async () => {
        try {
            const response = await axios.get('http://127.0.0.1:8000/api/products');

            categories.value = response.data.categories;
            products.value = response.data.products;

        } catch (error) {
            console.error('Error fetching data:', error);
        } finally {
            isLoading.value = false;
        }
    });

    const filters = ref({
        category: '',
        sortField: 'name', // Default sorting by name
        sortOrder: 'asc', // Default sorting order
        searchQuery: '', // Default empty search query
    });

    const filteredProducts = computed(() => {
        let filtered = [...products.value];

        // Filter by category
        if (filters.value.category) {
            filtered = filtered.filter(product => product.categories.some(category => category.name === filters
                .value.category));
        }

        // Filter by search query
        if (filters.value.searchQuery) {
            const query = filters.value.searchQuery.toLowerCase();
            filtered = filtered.filter(product =>
                product.name.toLowerCase().includes(query) ||
                product.description.toLowerCase().includes(query)
            );
        }

        // Sort the products
        filtered.sort((a, b) => {
            const order = filters.value.sortOrder === 'asc' ? 1 : -1;
            return order * (a[filters.value.sortField] - b[filters.value.sortField]);
        });

        return filtered;
    });
</script>

<style scoped>
    /* Add your scoped styles here */
</style>