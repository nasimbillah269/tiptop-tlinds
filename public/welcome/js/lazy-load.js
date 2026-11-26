/* ==========================================================================
   Tiptop Blinds - lazy images + scroll reveal (jQuery + IntersectionObserver)

   Images:  <img src="[1px placeholder]" data-src="real.jpg" class="tt-lazy">
            The real file is only requested when the image is about to enter the
            viewport. A shimmer skeleton (CSS) shows until it has loaded.
   Reveal:  product / blog cards that start below the fold fade up when scrolled
            into view. Cards already visible on load are never hidden, and nothing
            is hidden if this script fails, so content can't get stuck invisible.
   Dynamic: content inserted later (AJAX search, cart, pagination) is picked up
            automatically through a MutationObserver.
   ========================================================================== */
(function ($, window, document) {
    'use strict';

    var LAZY_SELECTOR = 'img.tt-lazy[data-src], [data-bg]';
    var REVEAL_SELECTOR = '.product-card, .blog-card, .tt-video-section .video-wrapper';
    var FALLBACK = window.ttNoImage || '';
    var hasIO = 'IntersectionObserver' in window;

    /* ---------- Images ---------- */
    function loadImage(el) {
        var $el = $(el);
        if ($el.data('ttLazyStarted')) return;
        $el.data('ttLazyStarted', true);

        // Background images (data-bg)
        if ($el.is('[data-bg]')) {
            var bg = $el.attr('data-bg');
            var bgLoader = new Image();
            bgLoader.onload = function () {
                el.style.backgroundImage = 'url("' + bg + '")';
                $el.removeAttr('data-bg').addClass('is-loaded');
            };
            bgLoader.onerror = function () { $el.removeAttr('data-bg').addClass('is-loaded is-error'); };
            bgLoader.src = bg;
            return;
        }

        var src = $el.attr('data-src');
        var srcset = $el.attr('data-srcset');

        // Decode off-screen first, then swap in one step: no half-drawn images.
        var loader = new Image();
        loader.onload = function () {
            if (srcset) el.srcset = srcset;
            el.src = src;
            // the fade-in is a CSS keyframe animation on .is-loaded, so add it right away
            $el.removeAttr('data-src data-srcset').addClass('is-loaded');
        };
        loader.onerror = function () {
            if (FALLBACK && src !== FALLBACK) el.src = FALLBACK;
            $el.removeAttr('data-src data-srcset').addClass('is-loaded is-error');
        };
        if (srcset) loader.srcset = srcset;
        loader.src = src;
    }

    var imageObserver = hasIO ? new IntersectionObserver(function (entries, obs) {
        $.each(entries, function (_, entry) {
            if (entry.isIntersecting) {
                obs.unobserve(entry.target);
                loadImage(entry.target);
            }
        });
    }, {
        rootMargin: '250px 0px', // start a little before the image scrolls into view
        threshold: 0.01
    }) : null;

    /* ---------- Reveal on scroll ---------- */
    var revealObserver = hasIO ? new IntersectionObserver(function (entries, obs) {
        $.each(entries, function (_, entry) {
            if (entry.isIntersecting) {
                obs.unobserve(entry.target);
                var $t = $(entry.target);
                // small stagger for cards in the same row
                var delay = Math.min(($t.data('ttRevealIndex') || 0) * 70, 280);
                window.setTimeout(function () { $t.addClass('is-visible'); }, delay);
            }
        });
    }, { rootMargin: '0px 0px -40px 0px', threshold: 0.08 }) : null;

    function isInViewport(el) {
        var r = el.getBoundingClientRect();
        return r.top < (window.innerHeight || document.documentElement.clientHeight) && r.bottom > 0;
    }

    /* ---------- jQuery plugins ---------- */
    $.fn.ttLazy = function () {
        return this.each(function () {
            if ($(this).data('ttLazyBound')) return;
            $(this).data('ttLazyBound', true);
            if (imageObserver) imageObserver.observe(this);
            else loadImage(this); // very old browsers: just load
        });
    };

    $.fn.ttReveal = function () {
        var row = 0, lastTop = null;
        return this.each(function () {
            var $el = $(this);
            if ($el.data('ttRevealBound') || !revealObserver) return;
            $el.data('ttRevealBound', true);
            if (isInViewport(this)) return; // never hide what the visitor already sees

            var top = Math.round(this.getBoundingClientRect().top);
            row = (top === lastTop) ? row + 1 : 0;
            lastTop = top;
            $el.data('ttRevealIndex', row).addClass('tt-reveal');
            revealObserver.observe(this);
        });
    };

    function scan(root) {
        var $root = $(root || document);
        $root.find(LAZY_SELECTOR).addBack(LAZY_SELECTOR).ttLazy();
        $root.find(REVEAL_SELECTOR).addBack(REVEAL_SELECTOR).ttReveal();
    }

    $(function () {
        scan(document);

        // Pick up content inserted later (AJAX search results, cart drawer, etc.)
        if ('MutationObserver' in window) {
            new MutationObserver(function (mutations) {
                $.each(mutations, function (_, m) {
                    $.each(m.addedNodes, function (_, node) {
                        if (node.nodeType === 1) scan(node);
                    });
                });
            }).observe(document.body, { childList: true, subtree: true });
        }
    });

    // Public helper if other scripts want to force a rescan
    window.ttLazyScan = scan;

})(jQuery, window, document);
