<template>
    <div>
        <input id="trix" type="hidden" :name="name" :value="value">
        <trix-editor ref='trix' input="trix" :placeholder="placeholder"></trix-editor>
    </div>
</template>

<script>
    import Trix from 'trix';

    export default {
        props: ['name', 'value', 'placeholder', 'shouldClear'],

        mounted() {
            this.$refs.trix.addEventListener('trix-change', event => {
                this.$emit('input', event.target.innerHTML);
            })

            this.$watch('shouldClear', () => {
                this.$refs.trix.value = '';
            });
        }
    }
</script>

<style scoped>

</style>