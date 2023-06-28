<script setup>
import { computed, onMounted, ref } from 'vue';
import AddCategoryForm from './components/AddCategoryForm.vue';
import Category from './components/Category.vue';

const categories = ref([]);

function loadCategories() {
  fetch('http://127.0.0.1:8080/get_categories.php')
  .then(data => data.json())
  .then(json => {
    categories.value = json
  })
}

onMounted(() => {
  loadCategories()
})

const filter = ref('')
const filteredCategories = computed(() => {
  return categories.value.filter((cat) => cat.name.toLowerCase().includes(filter.value.toLowerCase()))
})

</script>

<template>
  <h1>Lost items</h1>
  <input v-model="filter" placeholder="filter">
  <Category v-for="category in filteredCategories" :key="category.id" :category="category" @category-updated="loadCategories" />
  <AddCategoryForm @category-added="loadCategories" />
</template>