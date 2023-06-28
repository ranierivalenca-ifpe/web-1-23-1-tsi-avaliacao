<script setup>
import { ref } from 'vue';

const showUpdateForm = ref(false)
const name = ref(props.category.name)

const emit = defineEmits(['category-updated'])

const props = defineProps({
    category: Object
})

function submit() {
    const data = new FormData();
    data.append('id', props.category.id)
    data.append('name', name.value)

    fetch('http://127.0.0.1:8080/update_category.php', {
        method: 'POST',
        body: data
    })
        .then(data => data.json())
        .then(json => {
            if (json.success) {
                showUpdateForm.value = false
                emit('category-updated')
            }
        })
}

function remove() {
    if (!confirm('Are you sure?')) {
        return
    }
    const data = new FormData();
    data.append('id', props.category.id)

    fetch('http://127.0.0.1:8080/delete_category.php', {
        method: 'POST',
        body: data
    })
        .then(data => data.json())
        .then(json => {
            if (json.success) {
                emit('category-updated')
            }
        })
}
</script>

<template>
    <div>
        {{ category.name }}
        <span @click="showUpdateForm = !showUpdateForm">
            {{ showUpdateForm ? 'Close' : 'Edit' }}
        </span>
        <span @click="remove">Delete</span>
        <form v-if="showUpdateForm" @submit.prevent="submit">
            <input v-model="name">
            <button>update</button>
        </form>
    </div>
</template>

<style scoped>
div span {
    cursor: pointer;
}
</style>