const CATCH_NAME = "version-1";
const urlToCatch = ['/', 'offline.php'];

const self = this;

// installation service worker
self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(CATCH_NAME)
            .then((cache) => {
                console.log('Opened cache');
                return cache.addAll(urlToCatch);
            })
    )
})

//Listen for request
self.addEventListener('fetch', (event) => {
    event.respondWith(
        caches.match(event.request)
            .then(() => {
                return fetch(event.request)
            })
    )
})

//Activate the service worker
self.addEventListener('activate', (event) => {
    const cacheWhitelist = [];
    cacheWhitelist.push(CATCH_NAME);

    event.waitUntil(
        caches.keys().then((cacheNames) => Promise.all(
            cacheNames.map((cacheName) => {
                if(!cacheWhitelist.includes(cacheName)) {
                    return caches.delete(cacheName);
                }
            })
        ))
    )
})
