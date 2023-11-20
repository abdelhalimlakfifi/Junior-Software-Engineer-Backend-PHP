<script setup>


</script>

<template>
    
    
    <div class=" w-full flex justify-">
        <button type="submit" class="text-white bg-[#1b2440] hover:bg-[#141720] font-medium rounded-lg text-sm px-4 py-2 mb-2 w-full">
            New Product hahahaha
        </button>
    </div>

    <form>
        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50" placeholder="Search Mockups, Logos..." required>
            <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-[#f7941d] hover:bg-[#cd7000] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Search</button>
        </div>
    </form>

    

    <div class="grid grid-cols-4 w-full gap-5">
        <div v-for="index in 8" :key="index" class="mx-auto mt-11 transform overflow-hidden rounded-lg bg-white shadow-md duration-300 hover:scale-105 hover:shadow-lg">
            <img class="h-48 w-full object-cover object-center" src="https://images.unsplash.com/photo-1674296115670-8f0e92b1fddb?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80" alt="Product Image" />
            <div class="p-4">
                <h2 class="mb-2 text-lg font-medium text-gray-900">Product Name</h2>
                <p class="mb-2 text-base text-gray-700">Product description goes here.</p>
                
                <div class="flex items-center">
                    <p class="mr-2 text-lg font-semibold text-gray-900">$20.00</p>
                </div>
            </div>
        </div>


    </div>
</template>

<style scoped>

</style>