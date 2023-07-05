<script setup>
import { computed, onMounted, ref } from 'vue';
import AddCategoryForm from './components/AddCategoryForm.vue';
import AddItemForm from './components/AddItemForm.vue';
import Categories from './components/Categories.vue';
import Items from './components/Items.vue';

const categories = ref([]);
const items = ref([]);

function loadCategories() {
  fetch('http://localhost:8080/get_categories.php')
  .then(data => data.json())
  .then(json => {
    categories.value = json
  })

  loadItems()
}

function loadItems() {
  fetch('http://localhost:8080/get_items.php')
  .then(data => data.json())
  .then(json => {
    items.value = json
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
  <main>
    <div>
      <h2>Categories</h2>
      <div class="filter-wrapper">
        <input v-model="filter" placeholder="filter" class="filter">
        <div class="icon">
          <!-- search icon -->
          <svg viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M5.5 11.1455C5.49956 8.21437 7.56975 5.69108 10.4445 5.11883C13.3193 4.54659 16.198 6.08477 17.32 8.79267C18.4421 11.5006 17.495 14.624 15.058 16.2528C12.621 17.8815 9.37287 17.562 7.3 15.4895C6.14763 14.3376 5.50014 12.775 5.5 11.1455Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M15.989 15.4905L19.5 19.0015" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
        </div>
      </div>
      <div >
        <Categories :categories="filteredCategories" @category-updated="loadCategories" />
      </div>
      <h2>Items</h2>
      <div >
        <Items :items="items" :categories="categories" @item-updated="loadItems" />
      </div>
    </div>
    <div>
      <AddCategoryForm @category-added="loadCategories" />
      <AddItemForm :categories="categories" @item-added="loadItems" />
    </div>
  </main>
</template>

<style scoped>
h1 {
  text-align: center;
  border-bottom: 1px solid #ccc;
  margin-bottom: 1em;
}
h2 {
  /* margin-bottom: 0.5em; */
  margin-top: 2em;
  padding-bottom: 0.5em;
}

h2:first-of-type {
  margin-top: 0;
  padding-top: 0;
}

main {
  display: grid;
  grid-template-columns: 3fr 1fr;
  gap: 1em;
}
.filter-wrapper {
  display: flex;
}
.icon {
  left: 0;
  width: 2em;
  height: 2em;
  color: gray;
  transform: translateX(-2em);
  background: white;
}
.filter {
  padding-right: 2em;
}

</style>