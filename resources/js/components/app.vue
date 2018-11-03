<template>
    <div class="container">
        the content here
        <transition name="fade">
            <router-view>here</router-view>
        </transition>
    </div>
</template>

<script>
    export default {
        mounted(){
            console.log('Component mounted')
        }
    }
</script>
