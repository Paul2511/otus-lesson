<template>
    <div>
        <div class="comments-container">
            <ul v-if="items.length" class="user-comments-list">
                <li v-for="(item, index) in items" :key="index" class="commented-user flex items-start mb-4">
                    <div class="mr-3"><vs-avatar class="m-0" :src="item.user.avatar.thumb_src" size="30px" /></div>
                    <div class="comment-body leading-tight">
                        <div class="user-name font-medium">{{ item.user.name.displayName }}</div>
                        <div class="mb-3 comment-date text-xs">{{ item.formatCreatedAt }}</div>
                        <span class="text-sm comment-body">{{ item.body }}</span>
                    </div>
                    <div class="ml-auto" v-if="item.canEdit && !editMode">
                        <div class="flex">
                            <feather-icon
                                    icon="EditIcon"
                                    :title="$t('comment.edit')"
                                    svgClasses="h-4 w-4"
                                    class="mr-2 cursor-pointer"
                                    @click="edit(item)"
                            ></feather-icon>
                            <feather-icon
                                    icon="TrashIcon"
                                    :title="$t('comment.delete')"
                                    svgClasses="h-4 w-4"
                                    class="cursor-pointer"
                                    @click="del(item)"
                            ></feather-icon>
                        </div>
                    </div>
                </li>
            </ul>
            <p v-else>{{ $t('comment.none') }}</p>
        </div>

        <div class="post-comment mb-5 mt-5">
            <vs-textarea :placeholder="$t('comment.comment')" class="mb-4" v-model="comment.body"/>
            <vs-button size="small" @click="saveComment" :disabled="!comment.body || !comment.body.length">{{ $t('buttons.save') }}</vs-button>
            <vs-button v-if="editMode" type="border" size="small" @click="cancelEdit">{{ $t('buttons.cancel') }}</vs-button>
        </div>

    </div>
</template>
<script>
    export default {
        props: {
            items: {
                type: Array,
                default: []
            },
            type: {
                type: String,
                required: true
            },
            rowId: {
                type: Number,
                required: true
            }
        },
        data() {
            return {
                newComment: {
                    type: this.type,
                    row_id: this.rowId,
                    body: ''
                },
                comment: {},
                errors: [],
                editMode: false
            }
        },
        mounted() {
            this.clearComment();
        },

        methods: {
            clearComment() {
                this.editMode = false;
                this.comment = Object.assign({}, this.newComment);
            },
            saveComment() {
                this.$vs.loading();

                let action = this.isNew ? 'createComment' : 'updateComment';

                this.$store.dispatch(action, this.comment)
                    .then(res => {
                        if (!!res.data.message) {
                            this.$vs.notify({title:res.data.message.title, text: res.data.message.text, color: 'success', iconPack: 'feather', icon:'icon-check'});
                        }
                        if (this.isNew) {
                            this.items.push(res.data.data);
                        } else {
                            const index = this.items.findIndex(item => item.id === res.data.data.id);
                            this.items.splice(index, 1, res.data.data);
                        }
                        this.clearComment();
                    })
                    .catch(err => {
                        this.errors = err.response.data.errors ? err.response.data.errors : [];
                        this.$vs.notify({
                            title: this.$t('Error'),
                            text: err.response.data.message || this.$t('ErrorResponse'),
                            color: 'danger', iconPack: 'feather', icon:'icon-alert-circle'})
                    })
                    .finally(() => (this.$vs.loading.close()));
            },
            del(item) {
                let _this = this;

                this.$vs.dialog({
                    type: 'confirm',
                    color:'danger',
                    title: this.$t('main.confirmDelete'),
                    text: this.$t('comment.confirmDelete'),
                    acceptText: this.$t('buttons.delete'),
                    cancelText: this.$t('buttons.cancel'),
                    buttonsHidden: true,
                    accept:function () {
                        _this.acceptDel(item);
                    }
                })
            },
            acceptDel(item) {
                this.$vs.loading();
                this.$store.dispatch('deleteComment', item.id)
                    .then(res => {
                        if (!!res.data.message) {
                            this.$vs.notify({title:res.data.message.title, text: res.data.message.text, color: 'success', iconPack: 'feather', icon:'icon-check'});
                        }
                        this.items.splice(this.items.indexOf(item), 1);
                    })
                    .catch(err => {
                        this.$vs.notify({
                            title: this.$t('Error'),
                            text: err.response.data.message || this.$t('ErrorResponse'),
                            color: 'danger', iconPack: 'feather', icon:'icon-alert-circle'})
                    })
                    .finally(() => (this.$vs.loading.close()));
            },
            edit(item) {
                this.comment = Object.assign({}, item);
                this.editMode = true;
            },
            cancelEdit() {
                this.clearComment();
            }
        },
        computed: {
            user() {
                return this.$store.state.AppActiveUser
            },
            params() {
                return this.$store.state.appParams;
            },
            isNew() {
                return !this.comment.id;
            },
        },
    }
</script>

<style lang="scss" scoped>
    .commented-user {
        border-bottom: 1px solid rgba(255,255,255, 0.2);
        padding-bottom: 15px;
        padding-top: 15px;
        .user-name {
            margin-bottom: 5px;
        }
        .comment-body {
            white-space: pre-line;
        }
    }

</style>