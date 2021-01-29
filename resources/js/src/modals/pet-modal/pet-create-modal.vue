<template>
    <div>
        <b-modal
                id="pet-create-modal"
                centered
                :title="$t('pet.newPet')"
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
                        <strong>{{ $t('pet.name') }}:</strong>
                    </div>
                    <div class="vx-col sm:w-2/3 w-full">
                        <vs-input class="w-full" v-model="pet.name" :danger="!!errors.name" val-icon-danger="icon-x" val-icon-pack="feather" />
                        <div class="text-danger text-xs" v-show="!!errors.name">{{ errors.name | arr2str }}</div>
                    </div>
                </div>
                <div class="vx-row mb-6">
                    <div class="vx-col sm:w-1/3 w-full">
                        <strong>{{ $t('pet.type') }}:</strong>
                    </div>
                    <div class="vx-col sm:w-2/3 w-full">
                        <vs-select v-model="pet.pet_type_id" class="w-full" :danger="!!errors.pet_type_id" val-icon-danger="icon-x" val-icon-pack="feather">
                            <vs-select-item :key="petType.id" :value="petType.id" :text="petType.title" v-for="petType in petTypes" class="w-full" />
                        </vs-select>
                        <div class="text-danger text-xs" v-show="!!errors.pet_type_id">{{ errors.pet_type_id | arr2str }}</div>
                    </div>
                </div>
                <div class="vx-row mb-6">
                    <div class="vx-col sm:w-1/3 w-full">
                        <strong>{{ $t('pet.sex') }}:</strong>
                    </div>
                    <div class="vx-col sm:w-2/3 w-full">
                        <vs-select v-model="pet.sex" class="w-full" :danger="!!errors.sex" val-icon-danger="icon-x" val-icon-pack="feather">
                            <vs-select-item :key="index" :value="index" :text="item" v-for="(item,index) in petSexes" class="w-full" />
                        </vs-select>
                        <div class="text-danger text-xs" v-show="!!errors.sex">{{ errors.sex | arr2str }}</div>
                    </div>
                </div>
                <div class="vx-row mb-6">
                    <div class="vx-col sm:w-1/3 w-full">
                        <strong>{{ $t('pet.bread') }}:</strong>
                    </div>
                    <div class="vx-col sm:w-2/3 w-full">
                        <vs-input class="w-full" v-model="pet.bread" :danger="!!errors.bread" val-icon-danger="icon-x" val-icon-pack="feather" />
                        <div class="text-danger text-xs" v-show="!!errors.bread">{{ errors.bread | arr2str }}</div>
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
                pet: {},
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
                this.$store.dispatch('closePetCreateModal');
            },
            save(e) {
                e.preventDefault();

                this.$vs.loading();

                this.$store.dispatch('createPet', this.pet)
                    .then(res => {
                        if (!!res.data.message) {
                            this.$vs.notify({title:res.data.message.title, text: res.data.message.text, color: 'success', iconPack: 'feather', icon:'icon-check'});
                        }
                        this.$emit('reload');
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
            user() {
                return this.$store.state.AppActiveUser
            },
            params() {
                return this.$store.state.appParams;
            },
            petTypes() {
                return this.params.petTypes;
            },
            petSexes() {
                return this.params.petSexes;
            }
        },
    }
</script>
<style lang="scss" scoped>
    #photo-col {
        width: 10rem;
    }

    #pet-modal {
        table {
            td {
                //vertical-align: top;
                //min-width: 140px;
                padding-bottom: .8rem;
                //word-break: break-all;
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


    @media screen and (min-width:1201px) and (max-width:1211px),
    only screen and (min-width:636px) and (max-width:991px) {
        #pet-info-col-1 {
            //width: calc(100% - 12rem) !important;
        }
    }

</style>