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

    fetch('http://localhost:8080/update_category.php', {
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

    fetch('http://localhost:8080/delete_category.php', {
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
    <div class="category">
        <div :class="{content: !showUpdateForm, 'edit-mode': showUpdateForm}">
            <span v-if="!showUpdateForm">{{ category.name }}</span>
            <form v-if="showUpdateForm" @submit.prevent="submit">
                <input v-model="name">
                <div class="actions" v-if="showUpdateForm">
                    <span @click="submit" class="edit">
                        Save
                    </span>
                    <span @click="showUpdateForm = !showUpdateForm" class="remove">Cancel</span>
                </div>
            </form>
        </div>
        <div class="actions" v-if="!showUpdateForm">
            <span @click="showUpdateForm = !showUpdateForm" class="edit">
                Edit
            </span>
            <span @click="remove" class="remove">Delete</span>
        </div>
    </div>
</template>

<style scoped>
.category {
    /* border: 1px solid #ccc; */
    position: relative;
}

.content {
    border: 1px solid #ccc;
    border-top-left-radius: 1em;;
    border-top-right-radius: 1em;
    border-bottom: 0;
    padding: 1em;
}


.actions span {
    cursor: pointer;
}

.actions {
    display: grid;
    grid-template-columns: 1fr 1fr;
    text-align: center;
}

.actions .edit {
    color: black;
    background: var(--sky-400);
    padding: .5em;
    border-bottom-left-radius: 1em;
}

.actions .edit:hover {
    background: var(--sky-800);
    color: white;
}

.actions .remove {
    color: black;
    background: var(--red-400);
    padding: .5em;
    border-bottom-right-radius: 1em;
}

.actions .remove:hover {
    background: var(--red-800);
    color: white;
}
</style>