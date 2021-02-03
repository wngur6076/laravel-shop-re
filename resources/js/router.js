import VueRouter from 'vue-router'

// Pages
import Shop from './pages/Shop'
import Login from './pages/Login'
import Base from './pages/Base'
import NotFound from './pages/NotFound'

import Deposit from './pages/Deposit'
import Voucher from './pages/Voucher'
import ChargeHistory from './pages/ChargeHistory'
import BuyHistory from './pages/BuyHistory'
import SalesHistory from './pages/SalesHistory'
import MyProducts from './pages/MyProducts'
import ChargeAccept from './pages/ChargeAccept'

// Routes
const routes = [
    {
        path: '/',
        name: 'home',
        component: Shop,
        meta: {
            auth: {
                roles: true,
                redirect: {
                    name: 'login'
                },
                forbiddenRedirect: '/403'
            }
        },
    },
    {
        path: '/tags/:slug',
        name: 'tags.shop',
        component: Shop,
        meta: {
            auth: {
                roles: true,
                redirect: {
                    name: 'login'
                },
                forbiddenRedirect: '/403'
            }
        },
    },
    {
        path: '/charge',
        component: Base,
        meta: {
            auth: {
                roles: true,
                redirect: {
                    name: 'login'
                },
                forbiddenRedirect: '/403'
            }
        },
        children: [
            {
                path: '',
                name: 'charge.index',
                component: Deposit
            },
            {
                name: 'charge.deposit',
                path: 'deposit',
                component: Deposit
            },
            {
                name: 'charge.voucher',
                path: 'voucher',
                component: Voucher
            },
        ]
    },
    {
        path: '/history',
        component: Base,
        meta: {
            auth: {
                roles: true,
                redirect: {
                    name: 'login'
                },
                forbiddenRedirect: '/403'
            }
        },
        children: [
            {
                path: '',
                name: 'history.index',
                component: ChargeHistory
            },
            {
                name: 'history.charge',
                path: 'charge',
                component: ChargeHistory
            },
            {
                name: 'history.buy',
                path: 'buy',
                component: BuyHistory
            },
        ]
    },
    {
        path: '/admin',
        component: Base,
        meta: {
            auth: {
                roles: true,
                redirect: {
                    name: 'login'
                },
                forbiddenRedirect: '/403'
            }
        },
        children: [
            {
                path: '',
                name: 'admin.index',
                component: SalesHistory
            },
            {
                name: 'admin.sales',
                path: 'sales',
                component: SalesHistory
            },
            {
                name: 'admin.my-products',
                path: 'myproducts',
                component: MyProducts
            },
            {
                name: 'admin.accept',
                path: 'accept',
                component: ChargeAccept
            },
        ]
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            auth: false
        }
    },
    {
        path: '*',
        component: NotFound
    }
]

const router = new VueRouter({
    history: true,
    mode: 'history',
    linkActiveClass: 'active',
    routes,
})

export default router
