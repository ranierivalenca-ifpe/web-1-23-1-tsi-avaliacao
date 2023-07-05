<script setup>

import Category from './Category.vue';

defineProps({
    categories: Array
})

defineEmits(['category-updated'])

</script>

<template>
    <div class="categories">
        <Category v-for="category in categories" :key="category.id" :category="category" @category-updated="$emit('category-updated')" />
    </div>
</template>

<style scoped>
.categories {
    display: flex;
    flex-wrap: wrap;
    gap: 2em;
}
</style>