self.addEventListener('install', (event) => {
    event.waitUntil(
      caches.open('my-cache').then((cache) => {
        return cache.addAll([
          '/user.php',
          '/user_pp.php',
        ]);
      })
    );
  });
  
  self.addEventListener('install', (event) => {
    event.waitUntil(
      caches.open(cacheName).then((cache) => {
        return cache.addAll(assetsToCache);
      })
    );
  });
  
  self.addEventListener('fetch', (event) => {
    event.respondWith(
      caches.match(event.request).then((cachedResponse) => {
        return cachedResponse || fetch(event.request);
      })
    );
  });