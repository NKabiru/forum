<template>
    <div>
        <input id="trix" type="hidden" :name="name" :value="value">
        <trix-editor ref='trix' input="trix"></trix-editor>
    </div>
</template>

<script>
    import Trix from 'trix';

    export default {
        props: ['name', 'value'],

        mounted() {
            this.$refs.trix.addEventListener('trix-change', event => {
                this.$emit('input', event.target.innerHTML);
            })
        }
    }
</script>

<style scoped>

</style>