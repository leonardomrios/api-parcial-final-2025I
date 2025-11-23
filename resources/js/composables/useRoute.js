// Composable para generar rutas
export function useRoute() {
    const routes = {
        'dashboard': '/dashboard',
        'web.categories.index': '/categories',
        'web.categories.create': '/categories/create',
        'web.categories.show': (id) => `/categories/${id}`,
        'web.categories.edit': (id) => `/categories/${id}/edit`,
        'web.categories.store': '/categories',
        'web.categories.update': (id) => `/categories/${id}`,
        'web.categories.destroy': (id) => `/categories/${id}`,
        'web.computers.index': '/computers',
        'web.computers.create': '/computers/create',
        'web.computers.show': (id) => `/computers/${id}`,
        'web.computers.edit': (id) => `/computers/${id}/edit`,
        'web.computers.store': '/computers',
        'web.computers.update': (id) => `/computers/${id}`,
        'web.computers.destroy': (id) => `/computers/${id}`,
        'profile.show': '/user/profile',
        'logout': '/logout',
        'login': '/login',
        'login.store': '/login',
        'register': '/register',
        'register.store': '/register',
        'password.request': '/forgot-password',
    };

    const route = (name, ...params) => {
        const routePath = routes[name];
        if (typeof routePath === 'function') {
            return routePath(...params);
        }
        return routePath || '#';
    };

    return { route };
}

