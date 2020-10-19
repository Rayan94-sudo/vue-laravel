import clients from './pages/clients.vue';
import groups from './pages/groups.vue';
import addclient from './pages/AddClient.vue';
import addgroup from './pages/AddGroup.vue';
import editclient from './pages/EditClient.vue';
import editgroup from './pages/EditGroup.vue';
import translate from './pages/translate.vue';
import vuetestcomponent from './pages/vuexTestComponent.vue'
export const routes = [
    {
        name: 'clients',
        path: '/admin/clients',
        component: clients
    },
    {
        name: 'groups',
        path: '/admin/groups',
        component: groups
    },
    {
        name: 'AddClient',
        path: '/admin/addclient',
        component: addclient
    },
    {
        name: 'AddGroup',
        path: '/admin/addgroup',
        component: addgroup
    },
    {
        name: 'EditClient',
        path: '/admin/editclient/:id',
        component: editclient
    },
    {
        name: 'EditGroup',
        path: '/admin/editgroup/:id',
        component: editgroup
    },
    {
        name: 'Translate',
        path: '/admin/translate',
        component: translate
    },
    {
        name: 'VuexTest',
        path: '/admin/vuextest',
        component: vuetestcomponent
    },

];