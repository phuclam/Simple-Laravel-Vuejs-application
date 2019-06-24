import VueRouter from 'vue-router'

import NotFound from './pages/404.vue'
import Home from './pages/Home.vue'
import Rooms from './pages/Rooms.vue'
import RoomEdit from './pages/RoomEdit.vue'
import RoomAdd from './pages/RoomAdd.vue'

const ADMIN_PATH = '/admin';
const routes = [
    {path: ADMIN_PATH + '/', name: 'home', component: Home},
    {path: ADMIN_PATH + '/rooms', name: 'rooms', component: Rooms},
    {path: ADMIN_PATH + '/room/:id/edit', name: 'room.edit', component: RoomEdit},
    {path: ADMIN_PATH + '/room/add', name: 'room.add', component: RoomAdd},
    {path: '*', component: NotFound}
];

const router = new VueRouter({
    history: true,
    mode: 'history',
    routes
});

export default router