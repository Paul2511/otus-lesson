import Vue from 'vue'
import {AclInstaller, AclCreate, AclRule} from 'vue-acl'
import router from '@/router'

Vue.use(AclInstaller)

let initialRole = 'public'
const userInfo = JSON.parse(localStorage.getItem('userInfo'))
if (userInfo && userInfo.role) initialRole = userInfo.role

export default new AclCreate({
    initial: initialRole,
    notfound: '/login',
    router,
    acceptLocalRules: true,
    globalRules: {
        admin: new AclRule('admin').generate(),
        manager: new AclRule('manager').or('admin').generate(),
        spec: new AclRule('spec').generate(),
        client: new AclRule('client').generate(),
        inter:
            new AclRule('inter')
                .or('client')
                .or('spec')
                .or('manager')
                .or('admin')
                .generate(),
        public:
            new AclRule('public')
                .or('client')
                .or('spec')
                .or('manager')
                .or('admin')
                .generate(),
        canAdmin:
            new AclRule('canAdmin')
                .or('manager')
                .or('admin')
                .generate()
    }
})
