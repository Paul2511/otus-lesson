<template>
    <div class="vx-row">
        <!-- Avatar Col -->
        <div class="vx-col" id="avatar-col">
            <div class="img-container mb-4">
                <img :src="user.detail.avatar.src" class="rounded h-32 w-32" />
            </div>
        </div>

        <!-- Information - Col 1 -->
        <div class="vx-col flex-1" id="account-info-col-1">
            <table>
                <tr>
                    <td class="font-semibold">{{ $t('user.lastname') }}</td>
                    <td>{{ user.detail.lastname }}</td>
                </tr>
                <tr>
                    <td class="font-semibold">{{ $t('user.firstname') }}</td>
                    <td>{{ user.detail.firstname }}</td>
                </tr>
                <tr>
                    <td class="font-semibold">{{ $t('user.middlename') }}</td>
                    <td>{{ user.detail.middlename }}</td>
                </tr>
            </table>
        </div>
        <!-- /Information - Col 1 -->

        <!-- Information - Col 2 -->
        <div class="vx-col flex-1" id="account-info-col-2">
            <table>
                <tr>
                    <td class="font-semibold">{{ $t('user.phone') }}</td>
                    <td>{{ user.phoneFormat }}</td>
                </tr>
                <tr>
                    <td class="font-semibold">{{ $t('user.email') }}</td>
                    <td>{{ user.email }}</td>
                </tr>
                <tr v-if="canAdmin">
                    <td class="font-semibold">{{ $t('user.status') }}</td>
                    <td>
                        <vs-chip :color="user.statusColor">
                            {{ user.statusLabel }}
                        </vs-chip>
                    </td>
                </tr>
                <tr v-if="canAdmin">
                    <td class="font-semibold">{{ $t('user.role') }}</td>
                    <td>{{ user.roleLabel }}</td>
                </tr>
                <tr v-if="!!user.detail.specialization">
                    <td class="font-semibold">{{ $t('user.specialization') }}</td>
                    <td>{{ user.detail.specialization.name }}</td>
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