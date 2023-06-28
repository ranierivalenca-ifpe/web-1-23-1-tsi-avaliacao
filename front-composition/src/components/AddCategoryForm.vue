<script setup>
import { ref } from 'vue'

const emit = defineEmits(['category-added'])

const name = ref('')
function submit() {
  const data = new FormData();
  data.append('name', name.value);

  fetch('http://127.0.0.1:8080/add_category.php', {
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
        <input type="text" v-model="name">
        <button>Save</button>
    </form>
</template>