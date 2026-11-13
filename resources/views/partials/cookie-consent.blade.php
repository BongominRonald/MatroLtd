<!-- =========================================================================
     BRX AGRO GLOBAL — INSTITUTIONAL COOKIE CONSENT & PRIVACY PREFERENCES
     Designed to the highest design & contrast standards (WCAG AAA / LGPD / GDPR)
     ========================================================================= -->

<style>
    /* ===== Cookie Banner (High Contrast, Stripe/Linear/Apple-grade) ===== */
    #brxCookieBanner {
        position: fixed;
        bottom: 24px;
        left: 20px;
        right: 20px;
        max-width: 980px;
        margin: 0 auto;
        z-index: 1060;
        background: #0f172a; /* Deepest midnight slate for maximum contrast */
        border: 1px solid rgba(255, 255, 255, 0.18);
        border-top: 3.5px solid #78a22f; /* Signature BRX Agro Green accent line */
        box-shadow: 0 24px 60px rgba(0, 0, 0, 0.65), 0 0 1px 1px rgba(255, 255, 255, 0.08);
        border-radius: 16px;
        padding: 1.4rem 1.75rem;
        color: #ffffff;
        transform: translateY(170%);
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.35s ease, visibility 0.35s;
        opacity: 0;
        visibility: hidden;
    }
    #brxCookieBanner.show {
        transform: translateY(0);
        opacity: 1;
        visibility: visible;
    }

    /* High contrast text hierarchy */
    #brxCookieBanner .cookie-title {
        color: #ffffff !important;
        font-weight: 700;
        font-size: 1.05rem;
        letter-spacing: -0.2px;
    }
    #brxCookieBanner .cookie-body {
        color: #e2e8f0 !important; /* 90% slate white: contrast ratio > 12:1 against #0f172a */
        font-size: 0.86rem;
        line-height: 1.55;
    }
    #brxCookieBanner .cookie-link {
        color: #a3e635 !important; /* Bright accessible lime-green */
        text-decoration: underline;
        font-weight: 600;
        transition: color 0.2s ease;
    }
    #brxCookieBanner .cookie-link:hover {
        color: #ffffff !important;
    }

    /* Banner Buttons */
    .btn-cookie-accept {
        background-color: #78a22f !important;
        border: 1px solid #78a22f !important;
        color: #ffffff !important;
        font-weight: 700 !important;
        font-size: 0.88rem !important;
        padding: 0.6rem 1.25rem !important;
        border-radius: 10px !important;
        box-shadow: 0 4px 14px rgba(120, 162, 47, 0.35);
        transition: all 0.2s ease !important;
    }
    .btn-cookie-accept:hover {
        background-color: #648827 !important;
        border-color: #648827 !important;
        color: #ffffff !important;
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(120, 162, 47, 0.45);
    }
    .btn-cookie-necessary {
        background-color: #1e293b !important;
        border: 1px solid #475569 !important;
        color: #ffffff !important;
        font-weight: 600 !important;
        font-size: 0.84rem !important;
        padding: 0.55rem 1rem !important;
        border-radius: 10px !important;
        transition: all 0.2s ease !important;
    }
    .btn-cookie-necessary:hover {
        background-color: #334155 !important;
        border-color: #64748b !important;
        color: #ffffff !important;
    }
    .btn-cookie-manage {
        background-color: transparent !important;
        border: 1px solid #475569 !important;
        color: #cbd5e1 !important;
        font-weight: 600 !important;
        font-size: 0.84rem !important;
        padding: 0.55rem 1rem !important;
        border-radius: 10px !important;
        transition: all 0.2s ease !important;
    }
    .btn-cookie-manage:hover {
        background-color: #1e293b !important;
        border-color: #94a3b8 !important;
        color: #ffffff !important;
    }

    /* ===== Floating Re-open Badge (Pill with Cookie Icon) ===== */
    #btnFloatingCookieConsent {
        position: fixed;
        bottom: 24px;
        left: 24px;
        z-index: 1040;
        background: #0f172a;
        border: 2px solid #78a22f;
        color: #ffffff;
        padding: 7px 14px;
        border-radius: 9999px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.45);
        cursor: pointer;
        font-weight: 700;
        font-size: 0.8rem;
        letter-spacing: 0.2px;
        transition: all 0.25s ease;
    }
    #btnFloatingCookieConsent:hover {
        background: #78a22f;
        border-color: #648827;
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 10px 28px rgba(120, 162, 47, 0.45);
    }
    @media (max-width: 575.98px) {
        #btnFloatingCookieConsent span {
            display: none;
        }
        #btnFloatingCookieConsent {
            width: 42px;
            height: 42px;
            padding: 0;
            justify-content: center;
            border-radius: 50%;
        }
    }

    /* ===== Cookie Cards in Preferences Modal (Theme adaptive + High Contrast) ===== */
    .cookie-cat-card {
        border-radius: 12px;
        padding: 1.1rem 1.3rem;
        margin-bottom: 0.9rem;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    /* Dark Theme Modal */
    html[data-theme="dark"] .cookie-cat-card {
        background: #1e293b;
        border: 1px solid #334155;
    }
    html[data-theme="dark"] .cookie-cat-card:hover {
        border-color: #78a22f;
    }
    html[data-theme="dark"] .cookie-cat-title {
        color: #ffffff !important;
        font-weight: 700;
        font-size: 0.96rem;
    }
    html[data-theme="dark"] .cookie-cat-desc {
        color: #cbd5e1 !important; /* High contrast slate */
        font-size: 0.84rem;
        line-height: 1.55;
    }
    html[data-theme="dark"] .cookie-tech-code {
        background: rgba(255, 255, 255, 0.08);
        color: #93c5fd;
        padding: 2px 7px;
        border-radius: 4px;
        font-size: 0.76rem;
    }

    /* Light Theme Modal */
    html[data-theme="light"] .cookie-cat-card {
        background: #ffffff;
        border: 1px solid #cbd5e1;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }
    html[data-theme="light"] .cookie-cat-card:hover {
        border-color: #78a22f;
        box-shadow: 0 4px 14px rgba(120, 162, 47, 0.12);
    }
    html[data-theme="light"] .cookie-cat-title {
        color: #0f172a !important; /* Deep near-black for perfect contrast */
        font-weight: 700;
        font-size: 0.96rem;
    }
    html[data-theme="light"] .cookie-cat-desc {
        color: #334155 !important; /* Slate-700, WCAG AAA compliant */
        font-size: 0.84rem;
        line-height: 1.55;
    }
    html[data-theme="light"] .cookie-tech-code {
        background: #f1f5f9;
        color: #0369a1;
        padding: 2px 7px;
        border-radius: 4px;
        font-size: 0.76rem;
        border: 1px solid #e2e8f0;
    }

    /* Switch Styling */
    .cookie-switch {
        width: 46px !important;
        height: 24px !important;
        cursor: pointer;
    }
    .cookie-switch:checked {
        background-color: #78a22f !important;
        border-color: #78a22f !important;
    }
    .cookie-switch:focus {
        border-color: #78a22f !important;
        box-shadow: 0 0 0 0.25rem rgba(120, 162, 47, 0.25) !important;
    }

    /* Badge Contrast */
    .badge-always-active {
        background-color: #15803d !important;
        color: #ffffff !important;
        font-weight: 700 !important;
        font-size: 0.75rem !important;
        padding: 0.35rem 0.65rem !important;
        letter-spacing: 0.3px;
    }
</style>

<!-- Floating Re-open Badge -->
<button type="button" id="btnFloatingCookieConsent" onclick="BRXCookieManager.openPreferences()" title="Review or update your cookie preferences" aria-label="Open Cookie Preferences">
    <i class="bi bi-cookie text-warning fs-5"></i>
    <span>Cookie Preferences</span>
</button>

<!-- 1. Floating Cookie Consent Banner -->
<aside id="brxCookieBanner" role="region" aria-label="Cookie and Privacy Consent">
    <div class="row align-items-center g-3">
        <div class="col-lg-8">
            <div class="d-flex align-items-start gap-3">
                <div class="rounded-3 d-none d-sm-flex align-items-center justify-content-center flex-shrink-0" style="width: 46px; height: 46px; background: rgba(120, 162, 47, 0.25); color: #a3e635; font-size: 1.4rem; border: 1px solid rgba(120, 162, 47, 0.4);">
                    <i class="bi bi-shield-check"></i>
                </div>
                <div>
                    <div class="d-flex align-items-center gap-2 mb-1.5 flex-wrap">
                        <span class="cookie-title">We value your privacy</span>
                        <span class="badge bg-success bg-opacity-25 text-success border border-success border-opacity-50 py-1 px-2" style="font-size: 0.72rem; font-weight: 700;">
                            LGPD &bull; GDPR Compliant
                        </span>
                    </div>
                    <p class="cookie-body mb-2">
                        We use cookies and similar technologies to ensure our website operates securely, keep your trade sessions active, and remember your commodity cart preferences. With your permission, we also use cookies to improve performance and personalize your commercial experience.
                    </p>
                    <div class="d-flex align-items-center gap-3 small flex-wrap" style="font-size: 0.8rem;">
                        <a href="javascript:void(0)" onclick="BRXCookieManager.openPolicy()" class="cookie-link">
                            <i class="bi bi-file-earmark-lock2 me-1"></i>Read Cookie &amp; Privacy Policy
                        </a>
                        <span class="text-white-50">&bull;</span>
                        <a href="javascript:void(0)" onclick="BRXCookieManager.openPreferences()" class="cookie-link">
                            <i class="bi bi-sliders me-1"></i>Customize Settings
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="d-flex flex-column flex-sm-row flex-lg-column gap-2 justify-content-end">
                <button type="button" class="btn btn-cookie-accept w-100 d-flex align-items-center justify-content-center gap-2" onclick="BRXCookieManager.acceptAll()">
                    <i class="bi bi-check2-circle fs-6"></i> Accept all cookies
                </button>
                <div class="d-flex gap-2 w-100">
                    <button type="button" class="btn btn-cookie-necessary flex-fill text-nowrap" onclick="BRXCookieManager.rejectNonEssential()">
                        Necessary only
                    </button>
                    <button type="button" class="btn btn-cookie-manage flex-fill text-nowrap" onclick="BRXCookieManager.openPreferences()">
                        Customize
                    </button>
                </div>
            </div>
        </div>
    </div>
</aside>

<!-- 2. Interactive Cookie Preferences Modal -->
<div class="modal fade" id="cookiePreferencesModal" tabindex="-1" aria-labelledby="cookiePreferencesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden" style="background: var(--sh-surface); color: var(--bs-body-color); border: 1px solid var(--sh-border);">
            
            <div class="modal-header border-bottom border-secondary border-opacity-25 px-4 py-3" style="background: #0f172a; color: #ffffff;">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px; background: rgba(120, 162, 47, 0.25); color: #a3e635; font-size: 1.3rem; border: 1px solid rgba(120, 162, 47, 0.4);">
                        <i class="bi bi-sliders"></i>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold text-white mb-0" id="cookiePreferencesModalLabel" style="font-size: 1.15rem;">Cookie Preferences &amp; Settings</h5>
                        <small class="text-white-50" style="font-size: 0.78rem;">BRX AGRO GLOBAL IMPORTA&Ccedil;&Atilde;O E EXPORTA&Ccedil;&Atilde;O LTDA &bull; CNPJ 38.471.480/0001-41</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">
                <p class="small mb-3" style="color: var(--bs-secondary-color); font-size: 0.88rem; line-height: 1.55;">
                    When you visit our commercial trading platform, we store and retrieve information on your browser in the form of cookies. You can review each cookie category below and choose which optional cookies you authorize. Your preferences can be updated at any time.
                </p>

                <!-- Category 1: Strictly Necessary -->
                <div class="cookie-cat-card">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-shield-fill-check text-success fs-5"></i>
                            <span class="cookie-cat-title">Strictly Necessary &amp; Security Cookies</span>
                        </div>
                        <span class="badge badge-always-active rounded-pill">Always Active</span>
                    </div>
                    <p class="cookie-cat-desc mb-2.5">
                        These cookies are essential for you to browse the platform and use its core features, including logging into your Trade Desk account, keeping your commodity sample cart active, and protecting forms from security threats (CSRF). Because they are required for the website to function, they cannot be turned off.
                    </p>
                    <div class="small font-monospace">
                        <span class="fw-bold me-1" style="font-size: 0.76rem; color: var(--bs-secondary-color);">Active Cookies:</span>
                        <code class="cookie-tech-code">XSRF-TOKEN</code>
                        <code class="cookie-tech-code">brx_session</code>
                        <code class="cookie-tech-code">agrovia_cart</code>
                        <code class="cookie-tech-code">brx_cookie_consent</code>
                    </div>
                </div>

                <!-- Category 2: Functional & Trade Desk -->
                <div class="cookie-cat-card">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-chat-left-quote-fill text-primary fs-5"></i>
                            <span class="cookie-cat-title">Functional &amp; Trade Desk Cookies</span>
                        </div>
                        <div class="form-check form-switch m-0">
                            <input class="form-check-input cookie-switch" type="checkbox" role="switch" id="cookieSwitchFunctional" checked>
                        </div>
                    </div>
                    <p class="cookie-cat-desc mb-2.5">
                        These cookies enable advanced site functionality and personalization. They remember your Trade Desk inbox preferences, device email composition defaults, and interface customization (such as Light or Dark display themes).
                    </p>
                    <div class="small font-monospace">
                        <span class="fw-bold me-1" style="font-size: 0.76rem; color: var(--bs-secondary-color);">Active Cookies:</span>
                        <code class="cookie-tech-code">brx_inbox_pref</code>
                        <code class="cookie-tech-code">sh-theme</code>
                        <code class="cookie-tech-code">brx_desk_sync</code>
                    </div>
                </div>

                <!-- Category 3: Analytics & Performance -->
                <div class="cookie-cat-card">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-graph-up text-info fs-5"></i>
                            <span class="cookie-cat-title">Analytics &amp; Performance Cookies</span>
                        </div>
                        <div class="form-check form-switch m-0">
                            <input class="form-check-input cookie-switch" type="checkbox" role="switch" id="cookieSwitchAnalytics">
                        </div>
                    </div>
                    <p class="cookie-cat-desc mb-2.5">
                        These cookies help us understand how international buyers interact with our commodity listings. All information is aggregated and anonymous, helping our technical team optimize catalog load speeds and international CDN delivery times.
                    </p>
                    <div class="small font-monospace">
                        <span class="fw-bold me-1" style="font-size: 0.76rem; color: var(--bs-secondary-color);">Active Cookies:</span>
                        <code class="cookie-tech-code">_brx_perf</code>
                        <code class="cookie-tech-code">_brx_analytics</code>
                    </div>
                </div>

                <!-- Category 4: Commercial RFQ Attribution -->
                <div class="cookie-cat-card">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-bullseye text-warning fs-5"></i>
                            <span class="cookie-cat-title">Marketing &amp; Trade Attribution Cookies</span>
                        </div>
                        <div class="form-check form-switch m-0">
                            <input class="form-check-input cookie-switch" type="checkbox" role="switch" id="cookieSwitchMarketing">
                        </div>
                    </div>
                    <p class="cookie-cat-desc mb-2.5">
                        These cookies track the referral source of incoming institutional trade inquiries and RFQs. This ensures your account is assigned to the appropriate commodity desk officer (Grain, Sugar, Coffee, or Fertilizer).
                    </p>
                    <div class="small font-monospace">
                        <span class="fw-bold me-1" style="font-size: 0.76rem; color: var(--bs-secondary-color);">Active Cookies:</span>
                        <code class="cookie-tech-code">_brx_rfq_source</code>
                        <code class="cookie-tech-code">_brx_partner_ref</code>
                    </div>
                </div>

            </div>

            <div class="modal-footer border-top border-secondary border-opacity-25 px-4 py-3 d-flex flex-wrap justify-content-between align-items-center gap-2" style="background: var(--sh-surface);">
                <button type="button" class="btn btn-outline-secondary btn-sm px-3 fw-semibold" onclick="BRXCookieManager.rejectNonEssential()">
                    Reject non-essential
                </button>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-outline-success btn-sm px-3 fw-bold" onclick="BRXCookieManager.saveCustom()">
                        Save preferences
                    </button>
                    <button type="button" class="btn btn-success btn-sm px-3 fw-bold" style="background-color: #78a22f; border-color: #78a22f;" onclick="BRXCookieManager.acceptAll()">
                        Accept all
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
            
            <div class="modal-header border-bottom border-secondary border-opacity-25 px-4 py-3" style="background: #0f172a; color: #ffffff;">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px; background: rgba(120, 162, 47, 0.25); color: #a3e635; font-size: 1.3rem; border: 1px solid rgba(120, 162, 47, 0.4);">
                        <i class="bi bi-file-earmark-lock2-fill"></i>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold text-white mb-0" id="cookiePolicyModalLabel" style="font-size: 1.15rem;">Cookie &amp; Privacy Policy</h5>
                        <small class="text-white-50" style="font-size: 0.78rem;">Compliance with Brazilian LGPD (Lei 13.709/2018) &amp; EU GDPR (Regulation 2016/679)</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4" style="font-size: 0.88rem; line-height: 1.65;">
                <h6 class="fw-bold text-success mb-2 text-uppercase" style="letter-spacing: 0.5px; font-size: 0.84rem;">1. Data Controller Details</h6>
                <p class="mb-3" style="color: var(--bs-body-color);">
                    <strong>Company Name:</strong> BRX AGRO GLOBAL IMPORTA&Ccedil;&Atilde;O E EXPORTA&Ccedil;&Atilde;O LTDA<br>
                    <strong>CNPJ:</strong> 38.471.480/0001-41<br>
                    <strong>Registered Address:</strong> Av. Brig. Faria Lima, 3064 &ndash; Itaim Bibi, S&atilde;o Paulo &ndash; SP, 01451-001, Brazil<br>
                    <strong>Trade Desk Email:</strong> <a href="mailto:tradedesk@brxagroglobal.com" class="text-success text-decoration-none fw-semibold">tradedesk@brxagroglobal.com</a> &bull; <strong>DPO:</strong> <a href="mailto:privacy@brxagroglobal.com" class="text-success text-decoration-none fw-semibold">privacy@brxagroglobal.com</a>
                </p>

                <h6 class="fw-bold text-success mb-2 text-uppercase" style="letter-spacing: 0.5px; font-size: 0.84rem;">2. What Are Cookies and How Are They Used?</h6>
                <p class="mb-3" style="color: var(--bs-body-color);">
                    Cookies are small text files placed on your computer, tablet, or phone when you access our platform. They allow our systems to recognize your browser, maintain authenticated buyer sessions, remember selected commodity lots in your cart, and secure trade communications against unauthorized access.
                </p>

                <h6 class="fw-bold text-success mb-2 text-uppercase" style="letter-spacing: 0.5px; font-size: 0.84rem;">3. Cookies Used on This Platform</h6>
                <div class="table-responsive mb-3">
                    <table class="table table-bordered small align-middle" style="color: var(--bs-body-color);">
                        <thead class="table-dark">
                            <tr>
                                <th>Cookie Name</th>
                                <th>Classification</th>
                                <th>Purpose &amp; Description</th>
                                <th>Duration</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><code class="cookie-tech-code">XSRF-TOKEN</code></td>
                                <td><span class="badge bg-secondary">Strictly Necessary</span></td>
                                <td>Protects submitted trade requests, forms, and order checkouts against Cross-Site Request Forgery attacks.</td>
                                <td>Session / 2 hours</td>
                            </tr>
                            <tr>
                                <td><code class="cookie-tech-code">brx_session</code></td>
                                <td><span class="badge bg-secondary">Strictly Necessary</span></td>
                                <td>Maintains encrypted buyer session and portal authentication state.</td>
                                <td>2 hours</td>
                            </tr>
                            <tr>
                                <td><code class="cookie-tech-code">brx_cookie_consent</code></td>
                                <td><span class="badge bg-secondary">Strictly Necessary</span></td>
                                <td>Records your explicit cookie authorizations and consent preferences.</td>
                                <td>1 year</td>
                            </tr>
                            <tr>
                                <td><code class="cookie-tech-code">agrovia_cart</code></td>
                                <td><span class="badge bg-secondary">Strictly Necessary</span></td>
                                <td>Saves commodity lot selections, quantities, and CIF/FOB delivery terms during browsing.</td>
                                <td>Session</td>
                            </tr>
                            <tr>
                                <td><code class="cookie-tech-code">brx_inbox_pref</code></td>
                                <td><span class="badge bg-primary">Functional</span></td>
                                <td>Stores Trade Desk inbox drawer view states and device composer settings.</td>
                                <td>30 days</td>
                            </tr>
                            <tr>
                                <td><code class="cookie-tech-code">_brx_analytics</code></td>
                                <td><span class="badge bg-info text-dark">Analytics</span></td>
                                <td>Aggregates anonymous website usage and server response times to improve platform reliability.</td>
                                <td>90 days</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <h6 class="fw-bold text-success mb-2 text-uppercase" style="letter-spacing: 0.5px; font-size: 0.84rem;">4. Legal Framework &amp; International Compliance</h6>
                <p class="mb-3" style="color: var(--bs-body-color);">
                    In compliance with the Brazilian General Data Protection Law (<strong>LGPD, Art. 7, V</strong>) and the European General Data Protection Regulation (<strong>GDPR, Art. 6(1)(b)</strong>), strictly necessary cookies are processed for the execution of trade inquiries, contracts, and platform security. All optional cookies are processed strictly based on your affirmative, informed consent (<strong>LGPD Art. 7, I</strong> and <strong>GDPR Art. 6(1)(a)</strong>).
                </p>

                <h6 class="fw-bold text-success mb-2 text-uppercase" style="letter-spacing: 0.5px; font-size: 0.84rem;">5. Managing and Deleting Cookies</h6>
                <p class="mb-0" style="color: var(--bs-body-color);">
                    You can change or withdraw your consent at any time by clicking the <strong>Cookie Preferences</strong> button in our website footer or the floating badge at the bottom-left of the page. You may also configure your web browser (Chrome, Safari, Firefox, Edge) to block or delete cookies. Note that disabling strictly necessary cookies will prevent order checkout and account access.
                </p>
            </div>

            <div class="modal-footer border-top border-secondary border-opacity-25 px-4 py-2.5 d-flex justify-content-between align-items-center" style="background: var(--sh-surface);">
                <button type="button" class="btn btn-outline-success btn-sm fw-bold" onclick="BRXCookieManager.openPreferences()">
                    <i class="bi bi-sliders me-1"></i>Change Preferences
                </button>
                <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<!-- 4. Universal Cookie Governance JavaScript -->
<script>
    (function (window, document) {
        "use strict";

        var COOKIE_NAME = 'brx_cookie_consent';
        var STORAGE_KEY = 'brx_cookie_consent';

        var BRXCookieManager = {
            /**
             * Retrieve consent object from localStorage or browser cookie
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
             * Save user authorization choices and sync with backend
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

                // Store in browser cookie for 365 days
                var d = new Date();
                d.setTime(d.getTime() + (365 * 24 * 60 * 60 * 1000));
                document.cookie = COOKIE_NAME + "=" + encodeURIComponent(JSON.stringify(fullConsent)) + ";expires=" + d.toUTCString() + ";path=/;SameSite=Lax";

                // Post to backend API
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

                // Dispatch global event for external scripts (e.g. analytics scripts)
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
                    // Show banner after short 700ms initial view
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
