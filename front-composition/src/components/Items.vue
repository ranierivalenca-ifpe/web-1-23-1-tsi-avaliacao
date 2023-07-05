<script setup>

defineProps({
    items: Array,
    categories: Array
})

const emit = defineEmits(['item-updated'])

function updateCategory(item) {
    const data = new FormData();
    data.append('id', item.id)
    data.append('category_id', item.category_id)

    fetch('http://localhost:8080/update_item.php', {
        method: 'POST',
        body: data
    })
        .then(data => data.json())
        .then(json => {
            if (json.success) {
                emit('item-updated')
            }
        })
}

</script>

<template>
    <div class="items">
        <div class="header">
            <div>Category</div>
            <div>Name</div>
            <div>Description</div>
        </div>
        <div v-for="item in items" :key="item.id">
            <div>
                <!-- show category on a select input with the current selected, so it can be easy to change -->
                <select v-model="item.category_id" @change="updateCategory(item)">
                    <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
                </select>
            </div>
            <div>{{ item.name }}</div>
            <div>{{ item.description }}</div>
        </div>
    </div>
</template>

<style scoped>
.items > div {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 1em;
    border-bottom: 1px solid #ccc;
}

.items .header div {
    font-weight: bold;
}

.items select {
    width: 100%;
}
</style>