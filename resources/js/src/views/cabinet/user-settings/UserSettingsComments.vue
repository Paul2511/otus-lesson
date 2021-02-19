<template>
    <vx-card no-shadow>
        <comments-area type="user" :items="comments" :row-id="userId"/>
    </vx-card>
</template>

<script>
    import commentsArea from '@/modals/comments/comments.vue'
    export default {
        components: {
            commentsArea
        },
        data() {
            return {
                comments: []
            }
        },
        created() {
            let action = 'getUserComments';
            let userId = this.userId;

            this.$vs.loading();
            this.$store.dispatch(action, userId)
                .then(res => {
                    this.comments = res.data.data;
                })
                .catch(err => {
                    this.$vs.notify({
                        title: this.$t('Error'),
                        text: err.response.data.message || this.$t('ErrorResponse'),
                        color: 'danger', iconPack: 'feather', icon:'icon-alert-circle'})
                })
                .finally(() => (this.$vs.loading.close()));
        },
        computed: {
            userId() {
                return this.$route.params.userId ? Number(this.$route.params.userId) : null;
            }
        }
    }
</script>
