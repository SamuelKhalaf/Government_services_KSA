<?php
use Illuminate\Support\Facades\Route;

if (!function_exists('setActiveClass')) {
    /**
     * Set active class for menu links
     * Supports exact route matching and wildcard patterns
     * 
     * @param array|string $routes Route names or patterns to match
     * @param string $class CSS class to apply when route matches
     * @return string The class string if route matches, empty string otherwise
     */
    function setActiveClass($routes, $class = 'active')
    {
        $currentRoute = Route::currentRouteName();
        $routes = (array) $routes;
        
        foreach ($routes as $route) {
            // Exact route match
            if ($currentRoute === $route) {
                return $class;
            }
            
            // Wildcard route match (e.g., 'admin.companies.*')
            if (str_contains($route, '*')) {
                $pattern = str_replace(['\\*'], ['.*'], preg_quote($route, '/'));
                if (preg_match('/^' . $pattern . '$/', $currentRoute)) {
                    return $class;
                }
            }
            
            // Partial route match for nested routes
            // e.g., 'admin.companies' matches 'admin.companies.create', 'admin.companies.edit', etc.
            // But NOT 'admin.companies' itself (that should be exact match)
            if (str_starts_with($currentRoute, $route . '.') && $currentRoute !== $route) {
                return $class;
            }
        }
        
        return '';
    }
}

if (!function_exists('setMenuOpenClass')) {
    /**
     * Set menu open class for sidebar navigation
     * Supports exact route matching and wildcard patterns
     * 
     * @param array|string $routes Route names or patterns to match
     * @param string $class CSS classes to apply when route matches
     * @return string The class string if route matches, empty string otherwise
     */
    function setMenuOpenClass($routes, $class = 'show here')
    {
        $currentRoute = Route::currentRouteName();
        $routes = (array) $routes;
        
        foreach ($routes as $route) {
            // Exact route match
            if ($currentRoute === $route) {
                return $class;
            }
            
            // Wildcard route match (e.g., 'admin.companies.*')
            if (str_contains($route, '*')) {
                $pattern = str_replace(['\\*'], ['.*'], preg_quote($route, '/'));
                if (preg_match('/^' . $pattern . '$/', $currentRoute)) {
                    return $class;
                }
            }
            
            // Partial route match for nested routes
            // e.g., 'admin.companies' matches 'admin.companies.create', 'admin.companies.edit', etc.
            // But NOT 'admin.companies' itself (that should be exact match)
            if (str_starts_with($currentRoute, $route . '.') && $currentRoute !== $route) {
                return $class;
            }
        }
        
        return '';
    }
}
