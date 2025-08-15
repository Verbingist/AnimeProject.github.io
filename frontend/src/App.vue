<template>
  <router-view />
</template>

<script setup>
import { useRoute } from 'vue-router'
import { useHead }  from '@vueuse/head'

const route = useRoute()

useHead(() => ({
  title: route.meta.title
}))
</script>