<script setup>
    import { ref, onMounted } from 'vue';
    import axios from 'axios';
    import { useRouter } from 'vue-router'; 

    // Create a reactive variable to store the fetched data
    let responseData = ref(null);
    // Create a reactive variable to track the loading state
    const isLoading = ref(true);


    const formData = {
        file: null,
        title: '',
        category: 0,
        price: null,
        description: ''

    }
    // Use the mounted lifecycle hook to fetch data when the component is mounted

    const router = useRouter(); // Access the router instance

    const onSubmit = async () =>{
        const fd = new FormData();
        
        if(formData.category == 0)
        {
            alert("Please select a category");
            return;
        }
        fd.append('image', formData.file, formData.file.name);
        fd.append('title', formData.title);
        fd.append('category', formData.category);
        fd.append('price', formData.price);
        fd.append('description', formData.description);
        

        const response = await axios.post('http://127.0.0.1:8000/api/products/store', fd);

        console.log(response)
        if(response.status == 201){
            formData.file = null;
            formData.title = '';
            formData.category = 0;
            formData.price = null;
            formData.description = '';
            router.push('/');
        }
    }

    const onImageChange = (event) => {
        formData.file = event.target.files[0];
    }
    
    onMounted(async () => {
        try {
            const response = await axios.get('http://127.0.0.1:8000/api/categories');
            // Assuming the response contains data you want to display
            responseData = response.data;
        } catch (error) {

            console.error('Error fetching data:', error);
        } finally {
            // Update the loading state once the request is complete (whether successful or not)
            isLoading.value = false;
        }
    });
</script>

<template>
    
    <div v-if="isLoading">
        Loading...
    </div>
    <div>
        <!-- Your data rendering logic here -->
        <div v-if="responseData != null" class=" mt-5">
            <form @submit.prevent="onSubmit">
                <div class="relative z-0 w-full mb-6 group">
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="file_input">Upload Image</label>
                    <input @change="onImageChange" required class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" id="file_input" type="file">
                </div>

                <div class="relative z-0 w-full mb-6 group">
                    <input  v-model="formData.title" type="title"  name="title" id="title" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none" placeholder=" " required />
                    <label for="title"  class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Title</label>
                </div>


                <div class="relative z-0 w-full mb-6 group">
                    <input  v-model="formData.price" type="number" step="any" name="price" id="price" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none" placeholder=" " required />
                    <label for="price" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Price</label>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <label for="category" class="block mb-2 text-sm font-medium text-gray-900">Select a category</label>
                    <select  v-model="formData.category" required id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="0" selected>Choose a category</option>
                        <option v-for="category in responseData" :value="category.id" :key="category.id">{{ category.name }}</option>

                    </select>
                </div>

                <div class="relative z-0 w-full mb-6 group">
                    <label for="Description" class="block mb-2 text-sm font-medium text-gray-900 ">description</label>
                    <textarea v-model="formData.description" required id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Write your thoughts here..."></textarea>
                </div>

                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
            </form>
        </div>
        <div v-else>
            Not Fetched
        </div>
    </div>
</template>

<style scoped>
/* Your scoped styles here */
</style>
