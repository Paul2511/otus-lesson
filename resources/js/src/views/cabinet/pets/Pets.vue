<template>
    <div id="my-pets">
        <vs-button color="warning" class="mb-4 shadow-lg" icon="add_circle" @click="addPet()">
            {{ $t('pet.addPet') }}
        </vs-button>
        <vx-card no-shadow>
            <div v-if="isLoading" class="loading-block">
                <div class="loading-inner"></div>
            </div>
            <div v-else>
                <div class="vx-row">
                    <template v-if="pets.length">
                        <div v-for="pet in pets" class="vx-col w-full lg:w-1/3 sm:w-1/2 mb-base">
                            <vx-card :title="pet.name" :subtitle="pet.petTypeTitle">
                                <template slot="actions">
                                    <vs-dropdown vs-trigger-click>
                                        <a class="a-icon" href.prevent>
                                            <vs-icon class="" icon="more_vert"></vs-icon>
                                        </a>
                                        <vs-dropdown-menu>
                                            <vs-dropdown-item @click="editPetModal(pet.id)">
                                                {{ $t('buttons.edit') }}
                                            </vs-dropdown-item>
                                            <vs-dropdown-item @click="removePet(pet)">
                                                {{ $t('buttons.delete') }}
                                            </vs-dropdown-item>
                                        </vs-dropdown-menu>
                                    </vs-dropdown>
                                </template>
                                <img :src="pet.photo.src" alt="content-img" class="responsive rounded-lg">
                                <div class="flex justify-between flex-wrap">
                                    <vs-button
                                            icon="assignment"
                                            class="mt-4 mr-2 shadow-md"
                                            type="gradient"
                                            color="#7367F0"
                                            gradient-color-secondary="#CE9FFC"
                                            @click="openPetModal(pet.id)"
                                    >
                                        {{ $t('pet.questionary') }}
                                    </vs-button>

                                    <vs-button icon="assignment_turned_in" class="mt-4 shadow-md" type="gradient" color="success">
                                        {{ $t('pet.card') }}
                                    </vs-button>
                                </div>
                            </vx-card>
                        </div>
                    </template>
                    <template v-else>
                        <vs-alert color="dark" active="true">
                            {{ $t('pet.noPets') }}
                        </vs-alert>
                    </template>

                </div>
            </div>
        </vx-card>
    </div>
</template>

<script>
    export default {
        components: {},
        data() {
            return {
                isLoading: true,
                pets: []
            }
        },
        mounted() {
            if (this.isLoading) {
                this.$vs.loading({
                    container: '.loading-inner',
                    type: 'point'
                });
            }
        },
        created() {
            this.$store.dispatch('getPets')
                .then(res => {
                    this.pets = res.data.data
                })
                .catch(err => {
                    this.$vs.notify({
                        title: this.$t('Error'),
                        text: err.response.data.message || this.$t('ErrorResponse'),
                        color: 'danger',
                        iconPack: 'feather',
                        icon: 'icon-alert-circle'
                    })
                })
                .finally(() => (this.isLoading = false));
        },
        methods: {
            addPet() {
                this.$store.dispatch('openPetCreateModal');
            },
            removePet(pet) {
                let _this = this;
                this.$vs.dialog({
                    type: 'confirm',
                    color:'danger',
                    title: this.$t('main.confirmDelete'),
                    text: this.$t('pet.confirmDelete', {name: pet.name}),
                    acceptText: this.$t('buttons.delete'),
                    cancelText: this.$t('buttons.cancel'),
                    buttonsHidden: true,
                    accept:function () {
                        _this.acceptRemove(pet);
                    }
                })
            },
            acceptRemove(pet){
                this.$vs.loading();
                this.$store.dispatch('deletePet', pet.id)
                    .then(res => {
                        this.pets.splice(this.pets.indexOf(pet), 1);
                    })
                    .catch(err => {
                        this.$vs.notify({
                            title: this.$t('Error'),
                            text: err.response.data.message || this.$t('ErrorResponse'),
                            color: 'danger', iconPack: 'feather', icon:'icon-alert-circle'})
                    })
                    .finally(() => (this.$vs.loading.close()));
            },
            openPetModal(petId) {
                this.$store.dispatch('openPetModal', {petId: petId, isEdit: false});
            },
            editPetModal(petId) {
                this.$store.dispatch('openPetModal', {petId: petId, isEdit: true});
            },
        },

        computed: {
            user() {
                return this.$store.state.AppActiveUser
            },
            canAdmin() {
                return this.$acl.check('canAdmin')
            }
        },
    }
</script>
