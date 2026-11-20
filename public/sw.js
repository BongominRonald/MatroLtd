// BRX Agro Global Service Worker (PWA Offline Cache & Install)
const CACHE_NAME = 'brx-agro-v1';
const STATIC_ASSETS = [
    '/',
    '/site.webmanifest',
    '/img/icon-192x192.png',
    '/img/icon-512x512.png',
    '/img/apple-touch-icon.png'
];

self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME).then((cache) => cache.addAll(STATIC_ASSETS))
    );
    self.skipWaiting();
});

self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys().then((keys) => {
            return Promise.all(
                keys.filter((key) => key !== CACHE_NAME).map((key) => caches.delete(key))
            );
        })
    );
    self.clients.claim();
});

self.addEventListener('fetch', (event) => {
    // Network first, fallback to cache for offline navigation
    if (event.request.method === 'GET') {
        event.respondWith(
            fetch(event.request).catch(() => caches.match(event.request))
        );
    }
});
