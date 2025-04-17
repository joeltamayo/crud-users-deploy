<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class App extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Base Site URL
     * --------------------------------------------------------------------------
     * Puedes definir esta URL en tu entorno con `app.baseURL`
     * En Railway, asegúrate de tener esa variable definida.
     */
    public string $baseURL = '';

    /**
     * --------------------------------------------------------------------------
     * Index File
     * --------------------------------------------------------------------------
     */
    public string $indexPage = '';

    /**
     * --------------------------------------------------------------------------
     * Use .env
     * --------------------------------------------------------------------------
     */
    public bool $useDotEnv = true;

    /**
     * --------------------------------------------------------------------------
     * Constructor
     * --------------------------------------------------------------------------
     */
    public function __construct()
    {
        parent::__construct();

        // Detectar si viene de proxy HTTPS (como Railway)
        if (
            (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') ||
            (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
        ) {
            $_SERVER['HTTPS'] = 'on';
        }

        // Obtener baseURL desde variable de entorno (definida como app.baseURL en Railway)
        $base = env('app.baseURL');

        if ($base) {
            $this->baseURL = rtrim($base, '/') . '/';
        } else {
            $scheme = (! empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
            $host = $_SERVER['HTTP_HOST'] ?? 'localhost:8080';
            $this->baseURL = rtrim("{$scheme}://{$host}", '/') . '/';
        }
    }

    // --------------------------------------
    // El resto no cambia
    // --------------------------------------
    public array $allowedHostnames = [];
    public string $uriProtocol         = 'REQUEST_URI';
    public string $permittedURIChars   = 'a-z 0-9~%.:_\-';
    public string $defaultLocale       = 'en';
    public bool   $negotiateLocale     = false;
    public array  $supportedLocales    = ['en'];
    public string $appTimezone         = 'UTC';
    public string $charset             = 'UTF-8';

    /**
     * Forzar uso de HTTPS en todas las peticiones
     */
    public bool   $forceGlobalSecureRequests = true;

    public array  $proxyIPs            = [];
    public bool   $CSPEnabled          = false;
}
