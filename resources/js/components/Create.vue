<template>
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-gradient-primary text-white">
                <h1 class="card-title">Create An Item</h1>
            </div>
            <div class="card-body">
                <div v-if="successMessage" class="alert alert-success">
                    {{ successMessage }}
                </div>
                <form @submit.prevent="addItem">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="itemName" class="form-label">Item Name:</label>
                            <input type="text" class="form-control" id="itemName" v-model="item.name"
                                placeholder="Enter item name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="itemPrice" class="form-label">Item Price:</label>
                            <input type="text" class="form-control" id="itemPrice" v-model="item.price"
                                placeholder="Enter item price" required>
                        </div>
                    </div>
                    <div class="mt-4 text-center">
                        <button type="submit" class="btn btn-primary px-4"><i class="bi bi-plus-lg"></i> Add
                            Item</button>
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
import { reactive, ref } from 'vue';
import { useRouter } from 'vue-router';

export default {
    setup() {
        const item = reactive({ name: '', price: '' });
        const router = useRouter();
        const successMessage = ref('');

        const addItem = async () => {
            const uri = 'http://localhost:8000/items';
            try {
                await axios.post(uri, item);
                successMessage.value = 'Item added successfully!';
                setTimeout(() => {
                    successMessage.value = '';
                    router.push({ name: 'Index' });
                }, 1000);
            } catch (error) {
                console.error('Error adding item:', error);
                // Handle the error appropriately
            }
        };

        return {
            item,
            addItem,
            successMessage
        };
    }
}
</script>