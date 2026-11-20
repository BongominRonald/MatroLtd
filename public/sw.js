// BRX Agro Global Service Worker (Offline Cache & PWA Support)
const CACHE_NAME = 'brx-agro-offline-v2';
const OFFLINE_URL = '/offline.html';

const PRECACHE_ASSETS = [
    '/',
    OFFLINE_URL,
    '/site.webmanifest',
    '/favicon.ico',
    '/img/icon-192x192.png',
    '/img/icon-512x512.png',
    '/img/apple-touch-icon.png',
    '/img/brx-emblem-nav.png',
    '/lib/bootstrap/bootstrap-5.3.3.min.css',
    '/lib/bootstrap/bootstrap-5.3.3.bundle.min.js',
    '/lib/bootstrap-icons/bootstrap-icons.min.css',
    '/lib/jquery/jquery.min.js',
    '/fonts/comic-relief.css',
    '/fonts/open-sans.css',
    '/css/auth.css',
    '/style.css',
    '/script.js'
];

self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME).then((cache) => {
            // Attempt to precache all critical shell assets
            return Promise.allSettled(
                PRECACHE_ASSETS.map((asset) =>
                    cache.add(asset).catch((err) => {
                        console.warn('[SW] Precache asset skipped:', asset, err.message);
                    })
                )
            );
        })
    );
    self.skipWaiting();
});

self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys().then((keys) => {
            return Promise.all(
                keys.filter((key) => key !== CACHE_NAME).map((key) => caches.delete(key))
            );
        }).then(() => self.clients.claim())
    );
});

self.addEventListener('fetch', (event) => {
    // Only intercept GET requests (skip POST checkout/auth)
    if (event.request.method !== 'GET') {
        return;
    }

    const url = new URL(event.request.url);

    // Skip cross-origin or chrome-extension requests
    if (url.origin !== self.location.origin) {
        return;
    }

    // 1. Navigation Requests (Page loads): Network First, fallback to cached page or offline.html
    if (event.request.mode === 'navigate') {
        event.respondWith(
            fetch(event.request)
                .then((networkResponse) => {
                    if (networkResponse && networkResponse.status === 200) {
                        const copy = networkResponse.clone();
                        caches.open(CACHE_NAME).then((cache) => {
                            cache.put(event.request, copy);
                        });
                    }
                    return networkResponse;
                })
                .catch(() => {
                    // Offline: Return cached version of this page, or home page, or offline.html
                    return caches.match(event.request)
                        .then((cachedPage) => {
                            if (cachedPage) {
                                return cachedPage;
                            }
                            return caches.match('/')
                                .then((cachedHome) => {
                                    if (cachedHome) {
                                        return cachedHome;
                                    }
                                    return caches.match(OFFLINE_URL);
                                });
                        });
                })
        );
        return;
    }

    // 2. Static Assets (CSS, JS, Fonts, Images): Stale-While-Revalidate
    event.respondWith(
        caches.match(event.request).then((cachedResponse) => {
            const fetchPromise = fetch(event.request)
                .then((networkResponse) => {
                    if (networkResponse && networkResponse.status === 200) {
                        const copy = networkResponse.clone();
                        caches.open(CACHE_NAME).then((cache) => {
                            cache.put(event.request, copy);
                        });
                    }
                    return networkResponse;
                })
                .catch(() => cachedResponse);

            return cachedResponse || fetchPromise;
        })
    );
});
