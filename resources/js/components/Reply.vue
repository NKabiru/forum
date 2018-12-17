<template>
    <div :id="`reply-${this.id}`" class="card">
        <div class="card-header" :class="isBest ? 'card-header-success' : ''">
            <div class="level">
                <h6 class="flex">
                    <a :href="`/profiles/${reply.owner.name}`"
                    v-text="reply.owner.name">
                    </a>
                    said <span v-text="ago"></span>...
                </h6>

                <!--@if(auth()->check())-->
                <div v-if="signedIn">
                    <favorite :reply="reply"></favorite>
                </div>
                <!--@endif-->
            </div>

        </div>
        <div class="card-body">
            <div v-if="editing">
                <form @submit.prevent="update">
                    <div class="form-group">
                        <wysiwyg v-model="body"></wysiwyg>
                    </div>

                    <button class="btn btn-sm btn-primary">Update</button>
                    <button class="btn btn-sm btn-link" @click="editing = false" type="button">Cancel</button>
                </form>
            </div>

            <div v-else v-html="body"></div>
        </div>

        <!--@can('update', $reply)-->
        <div class="card-footer level" v-if="authorize('owns', reply) || authorize('owns', reply.thread)">
            <div v-if="authorize('owns', reply)">
                <button class="btn btn-sm mr-1" @click="editing = true">Edit</button>
                <button class="btn btn-danger btn-sm" @click="destroy">Delete</button>
            </div>
            <button class="btn btn-default btn-sm ml-auto" @click="markBestReply" v-if="authorize('owns', reply.thread)">Best Reply?</button>
        </div>
        <!--@endcan-->
    </div>
</template>

<script>
    import Favorite from './Favorite.vue';
    import moment from 'moment';

    export default {
        props: ['reply'],

        components: { Favorite },

        data() {
            return {
                editing: false,
                body: this.reply.body,
                id: this.reply.id,
                isBest: this.reply.isBest
            };
        },

        created() {
            window.events.$on('best-reply-selected', id => {
               this.isBest = (id === this.id);
            });
        },

        computed: {
            ago(){
                return moment(this.reply.created_at).fromNow();
            },
        },

        methods: {
            update(){
                axios.patch(
                    `/replies/${ this.id }`, {
                        body: this.body
                    })
                    .catch(error => {
                        flash(error.response.data, 'danger');
                    });

                this.editing = false;

                flash('Updated!');
            },

            destroy(){
                axios.delete(`/replies/${ this.id }`);

                this.$emit('deleted', this.id);
            },

            markBestReply() {
                axios.post('/replies/'+ this.id +'/best');

                window.events.$emit('best-reply-selected', this.id);
            },
        }
    }
</script>

<style scoped>
    .card-header-success {
        background-color: #84e79d;
    }
</style>