import VueRouter from 'vue-router'

import NotFound from './pages/404'
import HotelDetail from './pages/hotel/Detail'
import HotelEdit from './pages/hotel/Edit'
import Rooms from './pages/room/Index'
import RoomEdit from './pages/room/Edit'
import RoomAdd from './pages/room/Add'
import Types from './pages/type/Index'
import TypeEdit from './pages/type/Edit'
import TypeAdd from './pages/type/Add'
import Capacities from './pages/capacity/Index'
import CapacityEdit from './pages/capacity/Edit'
import CapacityAdd from './pages/capacity/Add'
import Customer from './pages/customer/Index'
import Bookings from './pages/booking/Index'
import BookingAdd from './pages/booking/Add'
import BookingEdit from './pages/booking/Edit'
import Prices from './pages/price/Index'
import PriceAdd from './pages/price/Add'
import PriceEdit from './pages/price/Edit'



const ADMIN_PATH = '/admin';
const routes = [
    {path: ADMIN_PATH + '/', name: 'home', component: HotelDetail},
    {path: ADMIN_PATH + '/hotel/edit', name: 'hotel.edit', component: HotelEdit},
    {path: ADMIN_PATH + '/rooms', name: 'rooms', component: Rooms},
    {path: ADMIN_PATH + '/room/:id/edit', name: 'room.edit', component: RoomEdit},
    {path: ADMIN_PATH + '/room/add', name: 'room.add', component: RoomAdd},
    {path: ADMIN_PATH + '/types', name: 'types', component: Types},
    {path: ADMIN_PATH + '/type/:id/edit', name: 'type.edit', component: TypeEdit},
    {path: ADMIN_PATH + '/type/add', name: 'type.add', component: TypeAdd},
    {path: ADMIN_PATH + '/capacities', name: 'capacities', component: Capacities},
    {path: ADMIN_PATH + '/capacity/:id/edit', name: 'capacity.edit', component: CapacityEdit},
    {path: ADMIN_PATH + '/capacity/add', name: 'capacity.add', component: CapacityAdd},
    {path: ADMIN_PATH + '/customers', name: 'customers', component: Customer},
    {path: ADMIN_PATH + '/bookings', name: 'bookings', component: Bookings},
    {path: ADMIN_PATH + '/booking/:id/edit', name: 'booking.edit', component: BookingEdit},
    {path: ADMIN_PATH + '/booking/add', name: 'booking.add', component: BookingAdd},
    {path: ADMIN_PATH + '/prices', name: 'prices', component: Prices},
    {path: ADMIN_PATH + '/price/:id/edit', name: 'price.edit', component: PriceEdit},
    {path: ADMIN_PATH + '/price/add', name: 'price.add', component: PriceAdd},
    {path: '*', component: NotFound}
];

const router = new VueRouter({
    history: true,
    mode: 'history',
    routes
});

export default router