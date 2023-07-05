<script setup>
import { ref } from 'vue'

const emit = defineEmits(['item-added'])

const name = ref('')
const description = ref('')
const category = ref('')

defineProps({
    categories: Array
})

function submit() {
  const data = new FormData();
  data.append('name', name.value);
  data.append('description', description.value);
  data.append('category', category.value);

  fetch('http://localhost:8080/add_item.php', {
    method: 'POST',
    body: data
  })
  .then(data => data.json())
  .then(json => {
    if (json.success) {
      name.value = ''
      emit('item-added')
    }
  })
}
</script>

<template>
    <form @submit.prevent="submit">
      <fieldset>
        <legend>Add item</legend>
        <input type="text" v-model="name" required name="category" placeholder="Category">
        <input type="text" v-model="description" required name="description" placeholder="Description">
        <select v-model="category" required>
            <option value="">Select category</option>
            <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
        </select>
        <button>Save</button>
      </fieldset>
    </form>
</template>