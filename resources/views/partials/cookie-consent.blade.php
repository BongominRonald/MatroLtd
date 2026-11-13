<!-- =========================================================================
     BRX AGRO GLOBAL — INSTITUTIONAL COOKIE CONSENT & LGPD/GDPR GOVERNANCE
     ========================================================================= -->

<style>
    /* Cookie Banner Container */
    #brxCookieBanner {
        position: fixed;
        bottom: 24px;
        left: 20px;
        right: 20px;
        max-width: 960px;
        margin: 0 auto;
        z-index: 1060;
        background: rgba(18, 24, 32, 0.98);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        border: 1px solid rgba(120, 162, 47, 0.45);
        box-shadow: 0 16px 44px rgba(0, 0, 0, 0.55), 0 0 20px rgba(120, 162, 47, 0.15);
        border-radius: 16px;
        padding: 1.25rem 1.5rem;
        color: #f1f5f9;
        transform: translateY(160%);
        transition: transform 0.45s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.35s ease, visibility 0.35s;
        opacity: 0;
        visibility: hidden;
    }
    #brxCookieBanner.show {
        transform: translateY(0);
        opacity: 1;
        visibility: visible;
    }

    /* Floating Re-Open Cookie Trigger */
    #btnFloatingCookieConsent {
        position: fixed;
        bottom: 24px;
        left: 24px;
        z-index: 1040;
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: #121820;
        border: 1.5px solid rgba(120, 162, 47, 0.5);
        color: #78a22f;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.15rem;
        box-shadow: 0 8px 24px rgba(0,0,0,0.35);
        cursor: pointer;
        transition: all 0.25s ease;
    }
    #btnFloatingCookieConsent:hover {
        background: #78a22f;
        color: #ffffff;
        transform: scale(1.08);
        box-shadow: 0 10px 28px rgba(120, 162, 47, 0.4);
    }

    /* Preference Switch styling */
    .form-check-input:checked {
        background-color: #78a22f;
        border-color: #78a22f;
    }
    .cookie-cat-card {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 12px;
        padding: 1rem 1.25rem;
        margin-bottom: 0.85rem;
        transition: border-color 0.2s ease;
    }
    .cookie-cat-card:hover {
        border-color: rgba(120, 162, 47, 0.3);
    }
    [data-theme="light"] .cookie-cat-card {
        background: #f8fafc;
        border-color: #e2e8f0;
    }
    [data-theme="light"] .cookie-cat-card:hover {
        border-color: #78a22f;
    }
</style>

<!-- Floating Re-open Badge -->
<button type="button" id="btnFloatingCookieConsent" onclick="BRXCookieManager.openPreferences()" title="Cookie & Privacy Settings" aria-label="Open Cookie Preferences">
    <i class="bi bi-shield-lock-fill"></i>
</button>

<!-- 1. Floating Cookie Consent Banner -->
<aside id="brxCookieBanner" role="region" aria-label="Cookie and Privacy Consent">
    <div class="row align-items-center g-3">
        <div class="col-lg-8">
            <div class="d-flex align-items-start gap-3">
                <div class="rounded-circle d-none d-sm-flex align-items-center justify-content-center flex-shrink-0" style="width: 44px; height: 44px; background: rgba(120, 162, 47, 0.18); color: #78a22f; font-size: 1.3rem;">
                    <i class="bi bi-shield-check"></i>
                </div>
                <div>
                    <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
                        <strong class="text-white" style="font-size: 0.98rem; letter-spacing: 0.3px;">Institutional Cookie &amp; Data Privacy Notice</strong>
                        <span class="badge bg-success bg-opacity-25 text-success border border-success border-opacity-25" style="font-size: 0.7rem;">LGPD &bull; GDPR Compliant</span>
                    </div>
                    <p class="mb-2 text-white-50 small" style="font-size: 0.82rem; line-height: 1.5;">
                        <strong>BRX AGRO GLOBAL IMPORTA&Ccedil;&Atilde;O E EXPORTA&Ccedil;&Atilde;O LTDA</strong> utilizes cookies to authenticate institutional trade sessions, maintain export cart dispatches, and protect trade desk messages. With your consent, we also utilize functional preferences to optimize your commodity origination experience under Brazilian <strong>LGPD (Lei 13.709/18)</strong> and EU <strong>GDPR (Regulation 2016/679)</strong>.
                    </p>
                    <div class="d-flex align-items-center gap-3 small" style="font-size: 0.78rem;">
                        <a href="javascript:void(0)" onclick="BRXCookieManager.openPolicy()" class="text-success text-decoration-none fw-semibold">
                            <i class="bi bi-file-earmark-text me-1"></i>Cookie Policy
                        </a>
                        <span class="text-white-50">&bull;</span>
                        <a href="javascript:void(0)" onclick="BRXCookieManager.openPreferences()" class="text-white-50 text-decoration-underline">
                            <i class="bi bi-sliders me-1"></i>Customize Preferences
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="d-flex flex-column flex-sm-row flex-lg-column gap-2 justify-content-end">
                <button type="button" class="btn btn-success fw-bold py-2 px-3 shadow-sm d-flex align-items-center justify-content-center gap-2" style="background-color: #78a22f; border-color: #78a22f; font-size: 0.88rem;" onclick="BRXCookieManager.acceptAll()">
                    <i class="bi bi-check2-circle"></i> Accept All Cookies
                </button>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-outline-light btn-sm flex-fill py-1.5 fw-semibold" style="font-size: 0.8rem;" onclick="BRXCookieManager.rejectNonEssential()">
                        Essential Only
                    </button>
                    <button type="button" class="btn btn-outline-secondary btn-sm flex-fill py-1.5 fw-semibold text-white-50" style="font-size: 0.8rem;" onclick="BRXCookieManager.openPreferences()">
                        Customize
                    </button>
                </div>
            </div>
        </div>
    </div>
</aside>

<!-- 2. Interactive Cookie Preferences Modal -->
<div class="modal fade" id="cookiePreferencesModal" tabindex="-1" aria-labelledby="cookiePreferencesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden" style="background: var(--sh-surface); color: var(--bs-body-color); border: 1px solid var(--sh-border);">
            
            <div class="modal-header border-bottom border-secondary border-opacity-25 px-4 py-3" style="background: #121820; color: #fff;">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; background: rgba(120, 162, 47, 0.2); color: #78a22f; font-size: 1.25rem;">
                        <i class="bi bi-sliders"></i>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold text-white mb-0" id="cookiePreferencesModalLabel" style="font-size: 1.15rem;">Cookie Preference Center</h5>
                        <small class="text-white-50" style="font-size: 0.76rem;">Manage your privacy and cookie authorizations &bull; BRX AGRO GLOBAL LTDA</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4" style="max-height: 65vh; overflow-y: auto;">
                <p class="small text-muted mb-3" style="font-size: 0.84rem; line-height: 1.5;">
                    When you visit our commercial trading platform, we store and retrieve information on your browser in the form of cookies. You can review each cookie category below and choose which optional cookies you authorize.
                </p>

                <!-- Category 1: Strictly Necessary -->
                <div class="cookie-cat-card">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-shield-fill-check text-success fs-5"></i>
                            <strong class="text-body fw-bold" style="font-size: 0.92rem;">Strictly Necessary &amp; Security Cookies</strong>
                        </div>
                        <span class="badge bg-success bg-opacity-25 text-success border border-success border-opacity-25 py-1 px-2" style="font-size: 0.72rem;">Always Active</span>
                    </div>
                    <p class="small text-muted mb-2" style="font-size: 0.8rem;">
                        Essential for basic platform operations, encrypted session security, CSRF defense, and cart order checkout. These cookies do not store personally unencrypted commercial data and cannot be turned off.
                    </p>
                    <div class="small text-muted-50 font-monospace" style="font-size: 0.72rem;">
                        Cookies: <code>XSRF-TOKEN</code>, <code>brx_session</code>, <code>agrovia_cart</code>, <code>brx_cookie_consent</code>
                    </div>
                </div>

                <!-- Category 2: Functional & Trade Desk -->
                <div class="cookie-cat-card">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-chat-left-quote-fill text-primary fs-5"></i>
                            <strong class="text-body fw-bold" style="font-size: 0.92rem;">Trade Desk &amp; Functional Cookies</strong>
                        </div>
                        <div class="form-check form-switch m-0">
                            <input class="form-check-input" type="checkbox" role="switch" id="cookieSwitchFunctional" checked>
                        </div>
                    </div>
                    <p class="small text-muted mb-2" style="font-size: 0.8rem;">
                        Powers real-time on-site Trade Desk message caching, device email sync preferences, and interface customizations (such as light/dark mode and delivery Incoterms memory).
                    </p>
                    <div class="small text-muted-50 font-monospace" style="font-size: 0.72rem;">
                        Cookies: <code>brx_inbox_pref</code>, <code>sh-theme</code>, <code>brx_desk_sync</code>
                    </div>
                </div>

                <!-- Category 3: Analytics & Performance -->
                <div class="cookie-cat-card">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-graph-up text-info fs-5"></i>
                            <strong class="text-body fw-bold" style="font-size: 0.92rem;">Analytics &amp; Origination Performance</strong>
                        </div>
                        <div class="form-check form-switch m-0">
                            <input class="form-check-input" type="checkbox" role="switch" id="cookieSwitchAnalytics">
                        </div>
                    </div>
                    <p class="small text-muted mb-2" style="font-size: 0.8rem;">
                        Enables anonymous traffic telemetry, CDN latency tracking, and commodity catalog interaction measurement to improve export order processing speed globally.
                    </p>
                    <div class="small text-muted-50 font-monospace" style="font-size: 0.72rem;">
                        Cookies: <code>_brx_perf</code>, <code>_brx_analytics</code>
                    </div>
                </div>

                <!-- Category 4: Commercial RFQ Attribution -->
                <div class="cookie-cat-card">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-bullseye text-warning fs-5"></i>
                            <strong class="text-body fw-bold" style="font-size: 0.92rem;">Commercial Attribution &amp; RFQ Tracking</strong>
                        </div>
                        <div class="form-check form-switch m-0">
                            <input class="form-check-input" type="checkbox" role="switch" id="cookieSwitchMarketing">
                        </div>
                    </div>
                    <p class="small text-muted mb-2" style="font-size: 0.8rem;">
                        Identifies referring trade channels and institutional campaigns to ensure your designated export origination officer is assigned to your account.
                    </p>
                    <div class="small text-muted-50 font-monospace" style="font-size: 0.72rem;">
                        Cookies: <code>_brx_rfq_source</code>, <code>_brx_partner_ref</code>
                    </div>
                </div>

            </div>

            <div class="modal-footer border-top border-secondary border-opacity-25 px-4 py-3 d-flex flex-wrap justify-content-between align-items-center gap-2">
                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="BRXCookieManager.rejectNonEssential()">
                    Reject Non-Essential
                </button>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-outline-success btn-sm px-3" onclick="BRXCookieManager.saveCustom()">
                        Save Preferences
                    </button>
                    <button type="button" class="btn btn-success btn-sm px-3 fw-bold" style="background-color: #78a22f; border-color: #78a22f;" onclick="BRXCookieManager.acceptAll()">
                        Accept All
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- 3. Full Cookie & Privacy Governance Modal -->
<div class="modal fade" id="cookiePolicyModal" tabindex="-1" aria-labelledby="cookiePolicyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden" style="background: var(--sh-surface); color: var(--bs-body-color); border: 1px solid var(--sh-border);">
            
            <div class="modal-header border-bottom border-secondary border-opacity-25 px-4 py-3" style="background: #121820; color: #fff;">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; background: rgba(120, 162, 47, 0.2); color: #78a22f; font-size: 1.25rem;">
                        <i class="bi bi-file-earmark-lock2-fill"></i>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold text-white mb-0" id="cookiePolicyModalLabel" style="font-size: 1.15rem;">Cookie &amp; Data Governance Policy</h5>
                        <small class="text-white-50" style="font-size: 0.76rem;">LGPD (Lei 13.709/2018) &bull; GDPR (Regulation 2016/679)</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4" style="font-size: 0.85rem; line-height: 1.6;">
                <h6 class="fw-bold text-success mb-2 text-uppercase" style="letter-spacing: 0.5px; font-size: 0.82rem;">1. Data Controller Identification</h6>
                <p class="text-muted mb-3">
                    <strong>BRX AGRO GLOBAL IMPORTA&Ccedil;&Atilde;O E EXPORTA&Ccedil;&Atilde;O LTDA</strong><br>
                    <strong>CNPJ:</strong> 38.471.480/0001-41<br>
                    <strong>Headquarters:</strong> Av. Brig. Faria Lima, 3064 &ndash; Itaim Bibi, S&atilde;o Paulo &ndash; SP, 01451-001, Brazil<br>
                    <strong>Trade Desk Email:</strong> <a href="mailto:tradedesk@brxagroglobal.com" class="text-success text-decoration-none">tradedesk@brxagroglobal.com</a> &bull; <strong>DPO Contact:</strong> <a href="mailto:privacy@brxagroglobal.com" class="text-success text-decoration-none">privacy@brxagroglobal.com</a>
                </p>

                <h6 class="fw-bold text-success mb-2 text-uppercase" style="letter-spacing: 0.5px; font-size: 0.82rem;">2. What Are Cookies?</h6>
                <p class="text-muted mb-3">
                    Cookies are small alphanumeric files transferred to your computer or mobile device through your browser. They enable our servers to recognize your authenticated trade sessions, store commodity inquiry lot carts, and secure our institutional trading portal against malicious automated requests.
                </p>

                <h6 class="fw-bold text-success mb-2 text-uppercase" style="letter-spacing: 0.5px; font-size: 0.82rem;">3. Comprehensive Table of Cookies Used</h6>
                <div class="table-responsive mb-3">
                    <table class="table table-sm table-bordered small">
                        <thead class="table-dark">
                            <tr>
                                <th>Cookie Name</th>
                                <th>Category</th>
                                <th>Purpose</th>
                                <th>Lifespan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><code>XSRF-TOKEN</code></td>
                                <td><span class="badge bg-secondary">Essential</span></td>
                                <td>Cross-Site Request Forgery (CSRF) token defense on RFQs and orders.</td>
                                <td>Session / 2h</td>
                            </tr>
                            <tr>
                                <td><code>brx_session</code></td>
                                <td><span class="badge bg-secondary">Essential</span></td>
                                <td>Encrypted user session identifier for authorized buyer authentication.</td>
                                <td>2 hours</td>
                            </tr>
                            <tr>
                                <td><code>brx_cookie_consent</code></td>
                                <td><span class="badge bg-secondary">Essential</span></td>
                                <td>Records your explicit cookie governance preferences (LGPD/GDPR).</td>
                                <td>1 year</td>
                            </tr>
                            <tr>
                                <td><code>agrovia_cart</code></td>
                                <td><span class="badge bg-secondary">Essential</span></td>
                                <td>Preserves commodity sample quantities and CIF/FOB selections during browsing.</td>
                                <td>Session</td>
                            </tr>
                            <tr>
                                <td><code>brx_inbox_pref</code></td>
                                <td><span class="badge bg-primary">Functional</span></td>
                                <td>Remembers Trade Desk inbox drawer state and compose preferences.</td>
                                <td>30 days</td>
                            </tr>
                            <tr>
                                <td><code>_brx_analytics</code></td>
                                <td><span class="badge bg-info">Analytics</span></td>
                                <td>Measures platform response time and catalog exploration patterns (anonymized).</td>
                                <td>90 days</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <h6 class="fw-bold text-success mb-2 text-uppercase" style="letter-spacing: 0.5px; font-size: 0.82rem;">4. Legal Bases for Processing</h6>
                <p class="text-muted mb-3">
                    In compliance with the Brazilian General Data Protection Law (<strong>LGPD, Art. 7, V</strong>) and the European General Data Protection Regulation (<strong>GDPR, Art. 6(1)(b)</strong>), essential cookies are processed for the performance of preliminary procedures related to commercial contracts. Optional cookies are processed based exclusively on your explicit consent (<strong>LGPD Art. 7, I</strong> and <strong>GDPR Art. 6(1)(a)</strong>).
                </p>

                <h6 class="fw-bold text-success mb-2 text-uppercase" style="letter-spacing: 0.5px; font-size: 0.82rem;">5. Revocation &amp; Browser Management</h6>
                <p class="text-muted mb-0">
                    You may adjust or revoke your cookie authorizations at any time by clicking the floating shield button on our website or through your web browser preferences (Google Chrome, Apple Safari, Mozilla Firefox, Microsoft Edge). Disabling essential cookies may impair the ability to place commodity orders or access your trading account.
                </p>
            </div>

            <div class="modal-footer border-top border-secondary border-opacity-25 px-4 py-2.5 d-flex justify-content-between align-items-center">
                <button type="button" class="btn btn-outline-success btn-sm" onclick="BRXCookieManager.openPreferences()">
                    <i class="bi bi-sliders me-1"></i>Edit Preferences
                </button>
                <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<!-- 4. Cookie Management Script -->
<script>
    (function (window, document) {
        "use strict";

        var COOKIE_NAME = 'brx_cookie_consent';
        var STORAGE_KEY = 'brx_cookie_consent';

        var BRXCookieManager = {
            /**
             * Get current consent object from cookie or localStorage
             */
            getConsent: function () {
                var stored = null;
                try {
                    stored = localStorage.getItem(STORAGE_KEY);
                    if (stored) return JSON.parse(stored);
                } catch (e) {}

                var cookieVal = this.getCookie(COOKIE_NAME);
                if (cookieVal) {
                    try { return JSON.parse(decodeURIComponent(cookieVal)); } catch (e) {}
                }

                return null;
            },

            /**
             * Save preferences locally and push to backend
             */
            savePreferences: function (prefs) {
                var fullConsent = {
                    essential: true,
                    functional: Boolean(prefs.functional),
                    analytics: Boolean(prefs.analytics),
                    marketing: Boolean(prefs.marketing),
                    timestamp: new Date().toISOString(),
                    version: '1.0'
                };

                try {
                    localStorage.setItem(STORAGE_KEY, JSON.stringify(fullConsent));
                } catch (e) {}

                // Set cookie for 365 days
                var d = new Date();
                d.setTime(d.getTime() + (365 * 24 * 60 * 60 * 1000));
                document.cookie = COOKIE_NAME + "=" + encodeURIComponent(JSON.stringify(fullConsent)) + ";expires=" + d.toUTCString() + ";path=/;SameSite=Lax";

                // Server-side sync via AJAX
                try {
                    fetch('/cookies/consent', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': (document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').getAttribute('content') : ''),
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(fullConsent)
                    }).catch(function () {});
                } catch (e) {}

                this.hideBanner();
                this.updateSwitches(fullConsent);

                // Dispatch event so other components can react
                window.dispatchEvent(new CustomEvent('brx:cookieConsentChanged', { detail: fullConsent }));
            },

            acceptAll: function () {
                this.savePreferences({ functional: true, analytics: true, marketing: true });
                this.closeModal('cookiePreferencesModal');
            },

            rejectNonEssential: function () {
                this.savePreferences({ functional: false, analytics: false, marketing: false });
                this.closeModal('cookiePreferencesModal');
            },

            saveCustom: function () {
                var functional = document.getElementById('cookieSwitchFunctional') ? document.getElementById('cookieSwitchFunctional').checked : true;
                var analytics = document.getElementById('cookieSwitchAnalytics') ? document.getElementById('cookieSwitchAnalytics').checked : false;
                var marketing = document.getElementById('cookieSwitchMarketing') ? document.getElementById('cookieSwitchMarketing').checked : false;

                this.savePreferences({ functional: functional, analytics: analytics, marketing: marketing });
                this.closeModal('cookiePreferencesModal');
            },

            showBanner: function () {
                var banner = document.getElementById('brxCookieBanner');
                if (banner) {
                    banner.classList.add('show');
                }
            },

            hideBanner: function () {
                var banner = document.getElementById('brxCookieBanner');
                if (banner) {
                    banner.classList.remove('show');
                }
            },

            openPreferences: function () {
                this.hideBanner();
                var current = this.getConsent();
                if (current) {
                    this.updateSwitches(current);
                }
                var modalEl = document.getElementById('cookiePreferencesModal');
                if (modalEl && window.bootstrap) {
                    var modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
                    modal.show();
                }
            },

            openPolicy: function () {
                var modalEl = document.getElementById('cookiePolicyModal');
                if (modalEl && window.bootstrap) {
                    var modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
                    modal.show();
                }
            },

            closeModal: function (id) {
                var modalEl = document.getElementById(id);
                if (modalEl && window.bootstrap) {
                    var modal = bootstrap.Modal.getInstance(modalEl);
                    if (modal) modal.hide();
                }
            },

            updateSwitches: function (consent) {
                var f = document.getElementById('cookieSwitchFunctional');
                var a = document.getElementById('cookieSwitchAnalytics');
                var m = document.getElementById('cookieSwitchMarketing');
                if (f) f.checked = Boolean(consent.functional);
                if (a) a.checked = Boolean(consent.analytics);
                if (m) m.checked = Boolean(consent.marketing);
            },

            getCookie: function (name) {
                var match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
                return match ? match[2] : null;
            },

            init: function () {
                var consent = this.getConsent();
                if (!consent) {
                    // Show banner after short 700ms initial page view
                    setTimeout(function () {
                        BRXCookieManager.showBanner();
                    }, 700);
                } else {
                    this.updateSwitches(consent);
                }
            }
        };

        window.BRXCookieManager = BRXCookieManager;

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function () { BRXCookieManager.init(); });
        } else {
            BRXCookieManager.init();
        }

    })(window, document);
</script>
