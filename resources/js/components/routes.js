const listContests = Vue.component('listcontests',require('./contests/listcontest.vue'));

const routes = [
    {
        name: 'listcontests',
        path: '/',
        component: listContests
    }
];

export default routes;
