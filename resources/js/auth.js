import bearer from '@websanova/vue-auth/drivers/auth/bearer'
import axios from '@websanova/vue-auth/drivers/http/axios.1.x'
import router from '@websanova/vue-auth/drivers/router/vue-router.2.x'
import oauth2Google from '@websanova/vue-auth/drivers/oauth2/google.js'
import oauth2Facebook from '@websanova/vue-auth/drivers/oauth2/facebook.js'

oauth2Google.params.client_id = '999926938099-6divji6tsjuf18nksgir3o37q0dh9665.apps.googleusercontent.com'
oauth2Facebook.params.client_id = '1299695560415953'

// Auth base configuration some of this options
// can be override in method calls
const config = {
    auth: bearer,
    http: axios,
    router: router,
    tokenDefaultKey:     'auth_token_default',
    tokenImpersonateKey: 'auth_token_impersonate',
    stores:              ['storage', 'cookie'],
    rolesKey: 'role',
    registerData: {url: 'auth/register', method: 'POST', redirect: ''},
    loginData: {url: 'auth/login', method: 'POST', redirect: '', fetchUser: true},
    logoutData: {url: 'auth/logout', method: 'POST', redirect: '/', makeRequest: true},
    fetchData: {url: 'auth/user', method: 'GET', enabled: true},
    refreshData: {url: 'auth/refresh', method: 'GET', enabled: true, interval: 30},
    oauth2: {
        google: oauth2Google,
        facebook: oauth2Facebook,
    }
}

export default config
