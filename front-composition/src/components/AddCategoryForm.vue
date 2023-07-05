<script setup>
import { ref } from 'vue'

const emit = defineEmits(['category-added'])

const name = ref('')
function submit() {
  const data = new FormData();
  data.append('name', name.value);

  fetch('http://localhost:8080/add_category.php', {
    method: 'POST',
    body: data
  })
  .then(data => data.json())
  .then(json => {
    if (json.success) {
      name.value = ''
      emit('category-added')
    }
  })
}
</script>

<template>
    <form @submit.prevent="submit">
      <fieldset>
        <legend>Add category</legend>
        <input type="text" v-model="name" name="category" placeholder="Category">
        <button>Save</button>
      </fieldset>
    </form>
</template>