const preLoad = function () {
    return caches.open("offline").then(function (cache) {
        // caching index and important routes
        return cache.addAll(filesToCache);
    });
};

self.addEventListener("install", function (event) {
    event.waitUntil(preLoad());
});

const filesToCache = [
    "/",
    "/offline.html",
    "logo.png",
    "assets/css/demo.css",
    "assets/img/illustrations/page-misc-error-light.png",
    "assets/img/favicon/favicon.ico",
    "assets/vendor/fonts/boxicons.css",
    "assets/vendor/css/core.css",
    "assets/vendor/css/theme-default.css",
    "assets/vendor/css/pages/page-misc.css",
    "assets/vendor/js/helpers.js",
    "assets/js/config.js",
    "assets/vendor/libs/jquery/jquery.js",
    "assets/vendor/libs/popper/popper.js",
    "assets/vendor/js/bootstrap.js",
    "assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js",
    "assets/vendor/js/menu.js",
    "assets/js/main.js",
];

const checkResponse = function (request) {
    return new Promise(function (fulfill, reject) {
        fetch(request).then(function (response) {
            if (response.status !== 404) {
                fulfill(response);
            } else {
                reject();
            }
        }, reject);
    });
};

const addToCache = function (request) {
    return caches.open("offline").then(function (cache) {
        return fetch(request).then(function (response) {
            return cache.put(request, response);
        });
    });
};

const returnFromCache = function (request) {
    return caches.open("offline").then(function (cache) {
        return cache.match(request).then(function (matching) {
            if (!matching || matching.status === 404) {
                return cache.match("offline.html");
            } else {
                return matching;
            }
        });
    });
};

self.addEventListener("fetch", function (event) {
    event.respondWith(
        checkResponse(event.request).catch(function () {
            return returnFromCache(event.request);
        })
    );
    if (!event.request.url.startsWith("http")) {
        event.waitUntil(addToCache(event.request));
    }
});
