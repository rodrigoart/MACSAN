<script setup>
import { Link } from '@inertiajs/inertia-vue3';
</script>

<template>
    <div class="p-5 bg-white rounded-full text-center">
        <Link :href="'/'">
            <img :src="'/img/macsan_logo.png'"  alt="macsan_logo" class="m-auto" width="80">
        </Link>
    </div>
</template>
