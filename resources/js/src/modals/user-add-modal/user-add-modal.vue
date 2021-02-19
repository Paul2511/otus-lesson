<template>
    <div>
        <b-modal
                id="user-add-modal"
                centered
                :title="$t('user.adding')"
                v-model="active"
                @hidden="close()"
                @ok="save"
                :ok-title="$t('buttons.create')"
                ok-variant="success"
                :cancel-title="$t('buttons.cancel')"
        >
            <div>
                <div class="vx-row mb-6">
                    <div class="vx-col sm:w-1/3 w-full">
                        <strong>{{ $t('user.role') }}:</strong>
                    </div>
                    <div class="vx-col sm:w-2/3 w-full">
                        <vs-select v-model="item.role" class="w-full" :danger="!!errors.role" val-icon-danger="icon-x" val-icon-pack="feather">
                            <vs-select-item :key="index" :value="index" :text="role" v-for="(role, index) in userRoles" class="w-full" />
                        </vs-select>
                        <div class="text-danger text-xs" v-show="!!errors.role">{{ errors.role | arr2str }}</div>
                    </div>
                </div>

                <div class="vx-row mb-6">
                    <div class="vx-col sm:w-1/3 w-full">
                        <strong>{{ $t('user.fullname') }}:</strong>
                    </div>
                    <div class="vx-col sm:w-2/3 w-full">
                        <vs-input required class="w-full" v-model="item.name" :danger="!!errors.name" val-icon-danger="icon-x" val-icon-pack="feather" />
                        <div class="text-danger text-xs" v-show="!!errors.name">{{ errors.name | arr2str }}</div>
                    </div>
                </div>

                <div class="vx-row mb-6">
                    <div class="vx-col sm:w-1/3 w-full">
                        <strong>{{ $t('user.email') }}:</strong>
                    </div>
                    <div class="vx-col sm:w-2/3 w-full">
                        <vs-input required class="w-full" v-model="item.email" :danger="!!errors.email" val-icon-danger="icon-x" val-icon-pack="feather" />
                        <div class="text-danger text-xs" v-show="!!errors.email">{{ errors.email | arr2str }}</div>
                    </div>
                </div>

                <div class="vx-row mb-6">
                    <div class="vx-col sm:w-1/3 w-full">
                        <strong>{{ $t('user.password') }}:</strong>
                    </div>
                    <div class="vx-col sm:w-2/3 w-full">
                        <vs-input required type="password" class="w-full" v-model="item.password" :danger="!!errors.password" val-icon-danger="icon-x" val-icon-pack="feather" />
                        <div class="text-danger text-xs" v-show="!!errors.password">{{ errors.password | arr2str }}</div>
                    </div>
                </div>

                <div class="vx-row mb-6">
                    <div class="vx-col sm:w-1/3 w-full">
                        <strong>{{ $t('user.confirmPassword') }}:</strong>
                    </div>
                    <div class="vx-col sm:w-2/3 w-full">
                        <vs-input required type="password" class="w-full" v-model="item.password_confirmation" :danger="!!errors.password" val-icon-danger="icon-x" val-icon-pack="feather" />
                        <div class="text-danger text-xs" v-show="!!errors.password_confirmation">{{ errors.password_confirmation | arr2str }}</div>
                    </div>
                </div>

                <div class="vx-row mb-6">
                    <div class="vx-col sm:w-1/3 w-full">

                    </div>
                    <div class="vx-col sm:w-2/3 w-full">
                        <vs-checkbox v-model="item.sendWelcomeEmail">Отправить письмо с данными</vs-checkbox>
                    </div>
                </div>

            </div>
        </b-modal>
    </div>
</template>

<script>
    import { BModal, BSpinner, BCard, BRow, BCol, BButton } from 'bootstrap-vue'
    export default {
        components: {BModal, BSpinner, BCard, BRow, BCol, BButton},
        data() {
            return {
                active: false,
                errors: [],
                item: {}
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

                this.$store.dispatch('createUser', this.item)
                    .then(res => {
                        if (!!res.data.message) {
                            this.$vs.notify({title:res.data.message.title, text: res.data.message.text, color: 'success', iconPack: 'feather', icon:'icon-check'});
                        }
                        this.$emit('created');
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
            params() {
                return this.$store.state.appParams;
            },
            userRoles() {
                return this.params.userRoles;
            },

        },
    }
</script>
<style lang="scss" scoped>
    #user-add-modal {
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