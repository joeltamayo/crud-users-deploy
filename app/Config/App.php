<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class App extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Base Site URL
     * --------------------------------------------------------------------------
     *
     * URL to your CodeIgniter root. Será calculada dinámicamente.
     */
    public string $baseURL = '';

    /**
     * --------------------------------------------------------------------------
     * Index File
     * --------------------------------------------------------------------------
     *
     * Para URLs limpias (sin index.php)
     */
    public string $indexPage = '';

    /**
     * --------------------------------------------------------------------------
     * Use .env
     * --------------------------------------------------------------------------
     *
     * Lo mantenemos true para lectura de otras variables (.env), 
     * pero NO usaremos env('app.baseURL') aquí.
     */
    public bool $useDotEnv = true;

    /**
     * --------------------------------------------------------------------------
     * Constructor
     * --------------------------------------------------------------------------
     *
     * Genera baseURL a partir de HTTPS y HTTP_HOST.
     */
    public function __construct()
    {
        parent::__construct();

        $scheme = (! empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
                  ? 'https'
                  : 'http';

        // Si HTTP_HOST no está definido (CLI/tests), usar localhost:8080 por defecto
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost:8080';

        // Normalizar para asegurarnos de que acaba en /
        $this->baseURL = rtrim($scheme . '://' . $host, '/') . '/';
    }

    // ... El resto de la configuración no cambia ...
    public array $allowedHostnames = [];
    public string $uriProtocol         = 'REQUEST_URI';
    public string $permittedURIChars   = 'a-z 0-9~%.:_\-';
    public string $defaultLocale       = 'en';
    public bool   $negotiateLocale     = false;
    public array  $supportedLocales    = ['en'];
    public string $appTimezone         = 'UTC';
    public string $charset             = 'UTF-8';
    public bool   $forceGlobalSecureRequests = false;
    public array  $proxyIPs            = [];
    public bool   $CSPEnabled          = false;
}
