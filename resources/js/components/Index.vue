<template>
    <div class="container mt-5">
        <h1 class="mb-4">Items</h1>
        <div v-if="successMessage" class="alert alert-success">
            {{ successMessage }}
        </div>
        <div class="d-flex justify-content-end mb-4">
            <router-link :to="{ name: 'Create' }" class="btn btn-success"><i class="bi bi-plus-lg"></i> Create New
                Item</router-link>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Item Name</th>
                        <th scope="col">Item Price</th>
                        <th scope="col" style="width: 20%;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in items" :key="item.id">
                        <td>{{ item.id }}</td>
                        <td>{{ item.name }}</td>
                        <td>{{ item.price }}</td>
                        <td>
                            <router-link :to="{ name: 'Edit', params: { id: item.id } }"
                                class="btn btn-sm btn-outline-primary me-2"><i class="bi bi-pencil-square me-1"></i>
                                Edit</router-link>
                            <button class="btn btn-sm btn-outline-danger" @click="openDeleteConfirmation(item.id)"> <i
                                    class="bi bi-trash me-1"></i> Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel"
        aria-hidden="true" ref="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" @click="closeModal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this item?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="closeModal">Cancel</button>
                    <button type="button" class="btn btn-danger" @click="confirmDelete">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel"
        aria-hidden="true" ref="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" @click="closeModal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this item?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="closeModal">Cancel</button>
                    <button type="button" class="btn btn-danger" @click="confirmDelete">Delete</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { onMounted, ref } from 'vue';

export default {
    setup() {
        const items = ref([]);
        const itemIdToDelete = ref(null);
        const deleteModal = ref(null);
        const successMessage = ref('');

        const fetchItems = async () => {
            try {
                const uri = 'http://localhost:8000/items';
                const response = await axios.get(uri);
                items.value = response.data;
            } catch (error) {
                console.error('Error fetching items:', error);
            }
        };

        const openDeleteConfirmation = (id) => {
            itemIdToDelete.value = id;
            const modalInstance = new bootstrap.Modal(deleteModal.value);
            modalInstance.show();
        };

        const closeModal = () => {
            const modalInstance = bootstrap.Modal.getInstance(deleteModal.value);
            if (modalInstance) {
                modalInstance.hide();
            }
        };

        const confirmDelete = async () => {
            if (itemIdToDelete.value !== null) {
                await deleteItem(itemIdToDelete.value);
                closeModal();
            }
        };

        const deleteItem = async (id) => {
            try {
                const uri = `http://localhost:8000/items/${id}`;
                await axios.delete(uri);
                items.value = items.value.filter((item) => item.id !== id);
                successMessage.value = 'Item deleted successfully!';
                setTimeout(() => {
                    successMessage.value = '';
                    router.push({ name: 'Index' });
                }, 1000);
            } catch (error) {
                console.error('Error deleting item:', error);
            }
        };

        onMounted(fetchItems);

        return {
            items,
            openDeleteConfirmation,
            confirmDelete,
            deleteItem,
            deleteModal,
            closeModal,
            successMessage
        };
    }
}
</script>