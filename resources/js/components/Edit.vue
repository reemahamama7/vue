<template>
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-gradient-primary text-white">
                <h1 class="card-title text-center">Edit an Item</h1>
            </div>
            <div class="card-body">
                <div v-if="successMessage" class="alert alert-success">
                    {{ successMessage }}
                </div>
                <form @submit.prevent="updateItem">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="itemName" class="form-label">Item Name:</label>
                            <input type="text" id="itemName" class="form-control" v-model="item.name"
                                placeholder="Enter item name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="itemPrice" class="form-label">Item Price:</label>
                            <input type="text" id="itemPrice" class="form-control" v-model="item.price"
                                placeholder="Enter item price" required>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary px-4">Update Item</button>
                    </div>
                </form>
                <div class="mt-4 d-flex justify-content-start">
                    <router-link :to="{ name: 'Index' }" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left-circle"></i> Return to Items List
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.bg-gradient-primary {
    background: linear-gradient(45deg, #007bff, #6610f2);
}
</style>

<script>
import { onMounted, reactive, ref } from 'vue';
import { useRoute, useRouter } from 'vue-router';

export default {
    setup() {
        const item = reactive({ name: '', price: '' });
        const route = useRoute();
        const router = useRouter();
        const successMessage = ref('');

        const getItem = async () => {
            try {
                const uri = `http://localhost:8000/items/${route.params.id}/edit`;
                const response = await axios.get(uri);
                Object.assign(item, response.data);
            }
            catch (error) {
                console.error("Failed to fetch item:", error);
            }
        };

        const updateItem = async () => {
            const uri = `http://localhost:8000/items/${route.params.id}`;
            console.log(uri)
            await axios.patch(uri, item);
            successMessage.value = 'Item Updated Successfully!';
            setTimeout(() => {
                successMessage.value = '';
                router.push({ name: 'Index' });
            }, 1000);
        };

        onMounted(getItem);

        return {
            item,
            updateItem,
            successMessage
        };
    }
}
</script>