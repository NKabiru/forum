<template>
    <div>
        <div v-for="(reply, index) in items" :key="reply.id">
            <reply :reply="reply" @deleted="remove(index)"></reply>
            <br>
        </div>

        <paginator :dataSet="dataSet" @changed="fetch"></paginator>

        <p v-if="$parent.locked">
            This thread has been locked. No more replies can be added.
        </p>

        <new-reply @created="add" v-else></new-reply>
    </div>
</template>

<script>
    import Reply from './Reply.vue';
    import NewReply from './NewReply.vue';
    import Paginator from './Paginator.vue';
    import collection from '../mixins/collection';

    export default {
        name: "Replies",

        mixins: [collection],

        components: { Reply, NewReply, Paginator },

        data() {
            return { dataSet: false }
        },

        created() {
            this.fetch();
        },


        methods: {
            fetch(page) {
                axios.get(this.url(page)).then(this.refresh);
            },

            refresh({data}) {
                this.dataSet = data;
                this.items = data.data;

                window.scrollTo(0, 0);
            },

            url(page){
                if (! page) {
                    let query = location.search.match(/page=(\d+)/);

                    page = query ? query[1] : 1;
                }

                return `${location.pathname}/replies?page=${page}`;
            }
        }
    }
</script>

<style scoped>

</style>