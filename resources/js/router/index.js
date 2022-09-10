import {createRouter, createWebHistory} from "vue-router";

import App from '../components/App.vue'
import ClientsIndex from '../components/Clients/ClientsIndex.vue'
import ClientsCreate from '../components/Clients/ClientsCreate.vue'
import ClientsEdit from '../components/Clients/ClientsEdit.vue'

const routes = [
    {
        path: '/',
        name: 'clients.index',
        component: ClientsIndex
    },
    {
        path: '/clients/create',
        name: 'clients.create',
        component: ClientsCreate
    },
    {
        path: '/clients/:id/edit',
        name: 'clients.edit',
        component: ClientsEdit,
        props: true
    }
]

export default createRouter({
    history: createWebHistory(),
    routes,
})
