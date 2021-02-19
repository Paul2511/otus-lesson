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

                <vs-tabs>
                    <vs-tab :label="$t('info')" icon-pack="feather" icon="icon-info" @click="changeActiveTab('info')">
                        <div class="tab-text mt-5">
                            <b-row class="align-items-center">
                                <b-col cols="12" xl="4" sm="6" xs="12" class="mb-5">
                                    <div class="img-container">
                                        <img class="img-thumbnail" :src="pet.photo.src"/>
                                    </div>
                                </b-col>
                                <b-col cols="12" xl="8" sm="6" xs="12" class="mb-5" v-if="edit">
                                    <input type="file" class="hidden" ref="update_photo_input" @change="uploadPhoto" accept="image/*">

                                    <vs-button
                                            id="button-upload-photo"
                                            class="mr-4 mb-2"
                                            @click="$refs.update_photo_input.click()"
                                            :disabled="uploading"
                                    >
                                        {{ changePhotoLabel }}
                                    </vs-button>

                                    <vs-button v-if="showPhotoDelete" @click="deletePhoto" type="border" color="danger">
                                        {{ $t('pet.deletePhoto') }}
                                    </vs-button>

                                    <p class="text-danger text-xs" v-show="!!errors.file">{{ errors.file | arr2str }}</p>
                                </b-col>
                            </b-row>

                            <b-row>
                                <b-col cols="12" xl="6">
                                    <table class="mt-2 mt-xl-0 w-100">
                                        <tr>
                                            <td class="font-semibold">{{ $t('pet.name') }}:</td>
                                            <td v-if="!edit">{{ pet.name }}</td>
                                            <td v-else class="mb-3">
                                                <vs-input v-model="pet.name" :danger="!!errors.name" val-icon-danger="icon-x" val-icon-pack="feather" />
                                                <div class="text-danger text-xs" v-show="!!errors.name">{{ errors.name | arr2str }}</div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="font-semibold">{{ $t('pet.type') }}:</td>
                                            <td v-if="!edit">{{ pet.petTypeTitle }}</td>
                                            <td v-else class="mb-3">
                                                <vs-select v-model="pet.pet_type_id" class="w-full" :danger="!!errors.pet_type_id" val-icon-danger="icon-x" val-icon-pack="feather">
                                                    <vs-select-item :key="petType.id" :value="petType.id" :text="petType.title" v-for="petType in petTypes" class="w-full" />
                                                </vs-select>
                                                <div class="text-danger text-xs" v-show="!!errors.pet_type_id">{{ errors.pet_type_id | arr2str }}</div>
                                            </td>
                                        </tr>

                                    </table>
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
                    </vs-tab>
                    <vs-tab v-if="$acl.check('canAdmin')" :label="$t('comments') + ' (' + pet.comments.length + ')'" icon-pack="feather" icon="icon-message-square" @click="changeActiveTab('comments')">
                        <div class="tab-text">
                            <div class="mt-4">
                                <comments type="pet" :items="pet.comments" :row-id="pet.id"></comments>
                            </div>

                        </div>
                    </vs-tab>
                </vs-tabs>
            </div>
            <template #modal-footer>
                <template v-if="edit">
                    <b-button variant="outline-secondary" @click="close()">
                        {{ $t('buttons.cancel') }}
                    </b-button>
                    <b-button v-if="activeTab === 'info'" variant="success" @click="save">
                        {{ $t('buttons.save') }}
                    </b-button>
                </template>
                <template v-else>
                    <b-button variant="outline-secondary" @click="close()">
                        {{ $t('buttons.close') }}
                    </b-button>
                    <b-button v-if="activeTab === 'info'" variant="info" @click="edit = true">
                        {{ $t('buttons.edit') }}
                    </b-button>
                </template>
            </template>
        </b-modal>
    </div>
</template>

<script>
    import { BModal, BSpinner, BCard, BRow, BCol, BButton } from 'bootstrap-vue'
    import comments from '../comments/comments.vue'
    export default {
        components: {BModal, BSpinner, BCard, BRow, BCol, BButton, comments},
        data() {
            return {
                isLoading: true,
                pet: undefined,
                active: false,
                edit: false,
                errors: [],
                oldPet: {},
                uploading: false,
                activeTab: 'info'
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
                        this.$emit(this.modalAction);
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
            uploadPhoto () {
                this.uploading = true;

                if (!!this.errors.file) {
                    this.errors.file = null;
                }

                this.$vs.loading({
                    container: "#button-upload-photo",
                    scale: 0.45
                });

                let formData = new FormData();

                let image = this.$refs.update_photo_input.files[0];
                formData.append('image', image);
                formData.append('uploadPath', 'pet.photo');
                formData.append('id', this.pet.id);

                this.$store.dispatch('uploadImage', formData)
                    .then(res => {
                        if (res.data.data) {
                            this.pet.photo = res.data.data;
                        }
                    })
                    .catch(err => {
                        this.errors = err.response.data.errors ? err.response.data.errors : [];
                        this.$vs.notify({
                            title: this.$t('Error'),
                            text: err.response.data.message || this.$t('ErrorResponse'),
                            color: 'danger', iconPack: 'feather', icon:'icon-alert-circle'})
                    })
                    .finally(() => {
                        this.uploading = false;
                        this.$vs.loading.close("#button-upload-photo > .con-vs-loading");
                    });
            },
            deletePhoto() {
                this.pet.photo = this.defaultPhoto;
            },
            changeActiveTab(tab) {
                this.activeTab = tab;
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
            modalAction() {
                return this.modalData.modalAction ? this.modalData.modalAction : 'reload';
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
            },
            changePhotoLabel() {
                const photo = this.pet.photo;
                if (!photo.type || photo.type === 'default') {
                    return this.$t('pet.uploadPhoto');
                }
                return this.$t('pet.changePhoto');
            },
            showPhotoDelete() {
                const photo = this.pet.photo;
                if (!!photo.type && photo.type === 'default') {
                    return false;
                }
                return true;
            },
            defaultPhoto() {
                return this.pet.defaultPhotos.find(p=>p.petType===this.pet.pet_type_id);
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