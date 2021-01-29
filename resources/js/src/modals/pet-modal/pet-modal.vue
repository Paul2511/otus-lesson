<template>
    <div>
        <b-modal
                id="pet-modal"
                centered
                size="lg"
                :title="isLoading?$t('Loading')+'...':$t('pet.pet')+' '+pet.name"
                v-model="active"
                @hidden="close"
                :busy="isLoading"
        >
            <div v-if="isLoading" class="loading-block d-flex justify-content-center align-items-center">
                <b-spinner variant="primary" type="grow" label="Spinning"></b-spinner>
            </div>

            <div v-else>
                <b-row>
                    <b-col cols="21" xl="6" class="d-flex justify-content-between flex-column">
                        <div class="d-flex justify-content-start">
                            <img :src="pet.photo.src" width="150px"/>
                            <div class="d-flex flex-column flex-1 ml-1">
                                <div class="mb-5">
                                    <h4 v-if="!edit" class="mb-0">
                                        {{ pet.name }}
                                    </h4>
                                    <div v-else class="mb-5">
                                        <vs-input v-model="pet.name" :danger="!!errors.name" val-icon-danger="icon-x" val-icon-pack="feather" />
                                        <div class="text-danger text-xs" v-show="!!errors.name">{{ errors.name | arr2str }}</div>
                                    </div>

                                    <div v-if="!edit" class="card-text">{{ pet.petTypeTitle }}</div>
                                    <template v-else>
                                        <vs-select v-model="pet.pet_type_id" class="w-full" :danger="!!errors.pet_type_id" val-icon-danger="icon-x" val-icon-pack="feather">
                                            <vs-select-item :key="petType.id" :value="petType.id" :text="petType.title" v-for="petType in petTypes" class="w-full" />
                                        </vs-select>
                                        <div class="text-danger text-xs" v-show="!!errors.pet_type_id">{{ errors.pet_type_id | arr2str }}</div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </b-col>
                    <b-col cols="12" xl="6">
                        <table class="mt-2 mt-xl-0 w-100">
                            <tr>
                                <td class="font-semibold">{{ $t('pet.sex') }}:</td>
                                <td v-if="!edit">{{ pet.currentSex.label }}</td>
                                <td v-else class="mb-3">
                                    <vs-select v-model="pet.sex" class="w-full" :danger="!!errors.sex" val-icon-danger="icon-x" val-icon-pack="feather">
                                        <vs-select-item :key="index" :value="index" :text="item" v-for="(item,index) in petSexes" class="w-full" />
                                    </vs-select>
                                    <div class="text-danger text-xs" v-show="!!errors.sex">{{ errors.sex | arr2str }}</div>
                                </td>
                            </tr>
                            <tr>
                                <td class="font-semibold">{{ $t('pet.bread') }}:</td>
                                <td v-if="!edit">{{ pet.bread }}</td>
                                <td v-else>
                                    <vs-input v-model="pet.bread" :danger="!!errors.bread" val-icon-danger="icon-x" val-icon-pack="feather" />
                                    <div class="text-danger text-xs" v-show="!!errors.bread">{{ errors.bread | arr2str }}</div>
                                </td>
                            </tr>
                        </table>
                    </b-col>
                </b-row>
            </div>
            <template #modal-footer>
                <div class="d-flex justify-content-between" style="width: 100%;">
                    <div>
                        <template v-if="!edit">
                            <b-button variant="info" @click="edit = true">
                                {{ $t('buttons.edit') }}
                            </b-button>
                            <b-button v-if="0" variant="danger" @click="removePet">
                                {{ $t('buttons.delete') }}
                            </b-button>
                        </template>
                        <template v-else>
                            <b-button variant="success" @click="save">
                                {{ $t('buttons.save') }}
                            </b-button>
                            <b-button variant="outline-secondary" @click="cancel">
                                {{ $t('buttons.cancel') }}
                            </b-button>
                        </template>
                    </div>
                    <b-button v-if="!edit" variant="outline-secondary" @click="close()">
                        {{ $t('buttons.close') }}
                    </b-button>
                </div>
            </template>
        </b-modal>
    </div>
</template>

<script>
    import { BModal, BSpinner, BCard, BRow, BCol, BButton } from 'bootstrap-vue'
    export default {
        components: {BModal, BSpinner, BCard, BRow, BCol, BButton},
        data() {
            return {
                isLoading: true,
                pet: undefined,
                active: false,
                edit: false,
                errors: [],
                oldPet: {}
            }
        },
        mounted() {
            this.edit = this.isEdit;
        },
        created() {
            this.active = true;
            this.$store.dispatch('getPet', this.petId)
                .then(res => {
                    this.isLoading = false;
                    this.pet = res.data.data,
                    this.oldPet = res.data.data
                })
                .catch(err => {
                    this.$vs.notify({
                        title: this.$t('Error'),
                        text: err.response.data.message || this.$t('ErrorResponse'),
                        color: 'danger',
                        iconPack: 'feather',
                        icon: 'icon-alert-circle'
                    });
                    this.close();
                })
                .finally(() => (this.isLoading = false));
        },
        methods: {
            close() {
                this.active = false;
                this.$store.dispatch('closePetModal');
            },
            removePet() {
                let _this = this;
                this.$vs.dialog({
                    type: 'confirm',
                    color:'danger',
                    title: this.$t('main.confirmDelete'),
                    text: this.$t('pet.confirmDelete', {name: this.pet.name}),
                    acceptText: this.$t('buttons.delete'),
                    cancelText: this.$t('buttons.cancel'),
                    buttonsHidden: true,
                    accept:function () {
                        _this.acceptRemove();
                    }
                })
            },
            acceptRemove(){
                this.$vs.loading();
                this.$store.dispatch('deletePet', this.petId)
                    .then(res => {
                        this.$emit('reload');
                    })
                    .catch(err => {
                        this.$vs.notify({
                            title: this.$t('Error'),
                            text: err.response.data.message || this.$t('ErrorResponse'),
                            color: 'danger', iconPack: 'feather', icon:'icon-alert-circle'})
                    })
                    .finally(() => (this.$vs.loading.close()));
            },
            cancel(){
                this.pet = this.oldPet;
                this.edit = false;
            },
            save() {
                this.$vs.loading();

                this.$store.dispatch('updatePet', {petId: this.petId, data: this.pet})
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
            modalData() {
                return this.$store.state.petModalOpened
            },
            petId() {
                return this.modalData.petId;
            },
            isEdit() {
                return this.modalData.isEdit;
            },
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