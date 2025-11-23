<template>
    <div class="relative">
        <div @click="open = !open">
            <slot name="trigger" />
        </div>

        <div v-show="open" 
             @click.stop
             class="absolute z-50 mt-2 rounded-md shadow-lg" 
             :class="[widthClass, alignmentClasses]"
             style="display: none;">
            <div class="rounded-md ring-1 ring-black ring-opacity-5" :class="contentClasses">
                <slot name="content" />
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';

const props = defineProps({
    align: {
        type: String,
        default: 'right',
    },
    width: {
        type: String,
        default: '48',
    },
    contentClasses: {
        type: Array,
        default: () => ['py-1', 'bg-white'],
    },
});

const open = ref(false);

const widthClass = computed(() => {
    return {
        '48': 'w-48',
        '60': 'w-60',
    }[props.width.toString()];
});

const alignmentClasses = computed(() => {
    if (props.align === 'left') {
        return 'origin-top-left left-0';
    } else if (props.align === 'right') {
        return 'origin-top-right right-0';
    } else {
        return 'origin-top';
    }
});

const handleClickOutside = (event) => {
    if (!event.target.closest('.relative')) {
        open.value = false;
    }
};

onMounted(() => {
    document.addEventListener('click', handleClickOutside);
});

onUnmounted(() => {
    document.removeEventListener('click', handleClickOutside);
});
</script>


