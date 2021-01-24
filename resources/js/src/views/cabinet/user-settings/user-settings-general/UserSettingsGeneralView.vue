<template>
    <div class="vx-row">
        <!-- Avatar Col -->
        <div class="vx-col" id="avatar-col">
            <div class="img-container mb-4">
                <img :src="user.avatar.src" class="rounded h-32 w-32" />
            </div>
        </div>

        <!-- Information - Col 1 -->
        <div class="vx-col flex-1" id="account-info-col-1">
            <table>
                <tr>
                    <td class="font-semibold">{{ $t('user.lastname') }}</td>
                    <td>{{ user.name.lastName }}</td>
                </tr>
                <tr>
                    <td class="font-semibold">{{ $t('user.firstname') }}</td>
                    <td>{{ user.name.firstName }}</td>
                </tr>
                <tr>
                    <td class="font-semibold">{{ $t('user.middlename') }}</td>
                    <td>{{ user.name.middleName }}</td>
                </tr>
            </table>
        </div>
        <!-- /Information - Col 1 -->


        <!-- Information - Col 2 -->
        <div class="vx-col flex-1" id="account-info-col-2">
            <table>
                <tr>
                    <td class="font-semibold">{{ $t('user.phone') }}</td>
                    <td>{{ user.phone.formatPhone }}</td>
                </tr>
                <tr>
                    <td class="font-semibold">{{ $t('user.email') }}</td>
                    <td>{{ user.email }}</td>
                </tr>
                <tr v-if="canAdmin && !!user.currentStatus">
                    <td class="font-semibold">{{ $t('user.status') }}</td>
                    <td>
                        <vs-chip :color="user.currentStatus.color">
                            {{ user.currentStatus.label }}
                        </vs-chip>
                    </td>
                </tr>
                <tr v-if="canAdmin">
                    <td class="font-semibold">{{ $t('user.role') }}</td>
                    <td>{{ user.currentRole.label }}</td>
                </tr>
                <tr v-if="!!user.specialist && !!user.specialist.specializationTitle">
                    <td class="font-semibold">{{ $t('user.specialization') }}</td>
                    <td>{{ user.specialist.specializationTitle }}</td>
                </tr>
            </table>
        </div>
        <!-- /Information - Col 2 -->

        <div class="vx-col w-full flex mt-4" id="account-manage-buttons">
            <vs-button icon-pack="feather" icon="icon-edit" class="mr-4" @click.native="edit">
                {{ $t('buttons.edit') }}
            </vs-button>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            user: {
                type: Object,
                required: true
            },
        },
        data() {
            return {

            }
        },
        methods: {
            edit() {
                this.$emit('edit');
            }
        },
        computed: {
            canAdmin() {
                return this.$acl.check('canAdmin')
            }
        }
    }

</script>