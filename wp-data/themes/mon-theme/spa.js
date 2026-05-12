(function () {
    var main = document.querySelector('main');

    function isSameOrigin(url) {
        try { return new URL(url).origin === location.origin; }
        catch (e) { return false; }
    }

    function isInternal(href) {
        if (!href || href.startsWith('#') || href.startsWith('mailto:') || href.startsWith('tel:')) return false;
        if (!isSameOrigin(href)) return false;
        if (/\/(wp-admin|wp-login|wp-cron)/.test(href)) return false;
        return true;
    }

    function parsePage(html) {
        var doc = (new DOMParser()).parseFromString(html, 'text/html');
        return {
            title: doc.title,
            main: doc.querySelector('main')
        };
    }

    function navigate(url, push) {
        main.classList.add('spa-loading');

        fetch(url)
            .then(function (r) { return r.text(); })
            .then(function (html) {
                var page = parsePage(html);
                if (!page.main) { location.href = url; return; }
                main.innerHTML = page.main.innerHTML;
                document.title = page.title;
                if (push) history.pushState(null, '', url);
                window.scrollTo(0, 0);
                main.classList.remove('spa-loading');
            })
            .catch(function () { location.href = url; });
    }

    document.addEventListener('click', function (e) {
        var link = e.target.closest('a');
        if (!link) return;
        var href = link.getAttribute('href');
        if (!isInternal(link.href)) return;
        e.preventDefault();
        if (link.href === location.href) return;
        navigate(link.href, true);
    });

    window.addEventListener('popstate', function () {
        navigate(location.href, false);
    });
})();
