<template>
    <component :is="as" :href="as === 'a' ? href : undefined" :class="classes" @click="handleClick">
        <slot />
    </component>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
    as: {
        type: String,
        default: 'a',
    },
    href: {
        type: String,
        default: null,
    },
});

const classes = computed(() => {
    return 'block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out';
});

const handleClick = (e) => {
    if (props.as === 'button') {
        e.preventDefault();
    }
};
</script>

