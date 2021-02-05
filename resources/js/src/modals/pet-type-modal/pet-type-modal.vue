<template>
    <div>
        <b-modal
                id="pet-type-modal"
                centered
                :title="isNew?$t('petType.add'):$t('petType.edit')"
                v-model="active"
                @hidden="close()"
                @ok="save"
                :ok-title="isNew?$t('buttons.add'):$t('buttons.save')"
                ok-variant="success"
                :cancel-title="$t('buttons.cancel')"
        >
            <div>
                <div class="vx-row mb-6">
                    <div class="vx-col sm:w-1/3 w-full">
                        <strong>{{ $t('slug') }}:  ⃰</strong>
                    </div>
                    <div class="vx-col sm:w-2/3 w-full">
                        <vs-input class="w-full" v-model="item.slug" :danger="!!errors.slug" val-icon-danger="icon-x" val-icon-pack="feather" />
                        <div class="text-danger text-xs" v-show="!!errors.slug">{{ errors.slug | arr2str }}</div>
                    </div>
                </div>
                <div v-for="translate in item.translates" :key="translate.locale" class="vx-row mb-6">
                    <div class="vx-col sm:w-1/3 w-full">
                        <strong>{{ $t('value') }} {{ translate.locale }}:</strong>
                    </div>
                    <div class="vx-col sm:w-2/3 w-full">
                        <vs-input class="w-full" v-model="translate.value" :danger="!!errors.translates" val-icon-danger="icon-x" val-icon-pack="feather" />
                        <div class="text-danger text-xs" v-show="!!errors.translates">{{ errors.translates | arr2str }}</div>
                    </div>
                </div>
            </div>
        </b-modal>
    </div>
</template>

<script>
    import Vue from 'Vue'
    import { BModal, BSpinner, BCard, BRow, BCol, BButton } from 'bootstrap-vue'
    export default {
        components: {BModal, BSpinner, BCard, BRow, BCol, BButton},
        props: {
            item: {
                type: Object,
                required: true
            },
        },
        data() {
            return {
                petType: undefined,
                active: false,
                errors: []
            }
        },
        mounted() {

        },
        created() {
            this.active = true;
        },
        methods: {
            close() {
                this.active = false;
                this.$emit('close');
            },
            save(e) {
                e.preventDefault();

                this.$vs.loading();

                let action = this.isNew ? 'createPetType' : 'updatePetType';

                this.$store.dispatch(action, this.item)
                    .then(res => {
                        if (!!res.data.message) {
                            this.$vs.notify({title:res.data.message.title, text: res.data.message.text, color: 'success', iconPack: 'feather', icon:'icon-check'});
                        }
                        this.$emit('changed', res.data.data);
                    })
                    .catch(err => {
                        this.errors = err.response.data.errors ? err.response.data.errors : [];
                        this.$vs.notify({
                            title: this.$t('Error'),
                            text: err.response.data.message || this.$t('ErrorResponse'),
                            color: 'danger', iconPack: 'feather', icon:'icon-alert-circle'})
                    })
                    .finally(() => (this.$vs.loading.close()));
            }
        },
        computed: {
            isNew() {
                return !this.item.id;
            }
        },
    }
</script>
<style lang="scss" scoped>
    #pet-type-modal {
        table {
            td {
                padding-bottom: .8rem;
            }

            &:not(.permissions-table) {
                td {
                    @media screen and (max-width:370px) {
                        display: block;
                    }
                }
            }
        }
    }
</style>