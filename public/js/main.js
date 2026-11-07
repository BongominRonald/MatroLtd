(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();


    // Initiate the wowjs
    if (typeof WOW !== 'undefined') {
        new WOW().init();
    }


    // Sticky Navbar
    $(window).scroll(function () {
        if ($(this).scrollTop() > 30) {
            $('.navbar').addClass('scrolled shadow-sm');
        } else {
            $('.navbar').removeClass('scrolled shadow-sm');
        }
    });


    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn('slow').css('display', 'flex');
        } else {
            $('.back-to-top').fadeOut('slow').css('display', 'none');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({
            scrollTop: 0
        }, 1200, 'easeInOutExpo');
        return false;
    });


    // ==========================================
    // AGROVIA TOAST NOTIFICATION SYSTEM
    // ==========================================
    window.showAgroviaToast = function (title, message, iconClass, type) {
        var toast = $('#agroviaToast');
        if (toast.length === 0) {
            $('body').append(`
                <div id="agroviaToast" class="agrovia-toast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex align-items-start">
                        <div class="toast-icon me-3 mt-1 fs-3"></div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <strong class="toast-title text-dark fw-bold"></strong>
                                <small class="text-muted ms-2">Just now</small>
                            </div>
                            <div class="toast-body text-secondary p-0 small"></div>
                        </div>
                        <button type="button" class="btn-close ms-2" onclick="$('#agroviaToast').fadeOut(200);"></button>
                    </div>
                </div>
            `);
            toast = $('#agroviaToast');
        }

        var icon = iconClass || 'fa fa-check-circle text-primary';
        var borderColor = '#28a745';
        if (type === 'danger') {
            borderColor = '#dc3545';
            icon = 'fa fa-exclamation-triangle text-danger';
        } else if (type === 'info') {
            borderColor = '#0dcaf0';
            icon = 'fa fa-info-circle text-info';
        }

        toast.css('border-left-color', borderColor);
        toast.find('.toast-icon').html('<i class="' + icon + '"></i>');
        toast.find('.toast-title').text(title || 'Agrovia Notification');
        toast.find('.toast-body').text(message || '');

        toast.stop(true, true).fadeIn(300);

        if (window.agroviaToastTimer) {
            clearTimeout(window.agroviaToastTimer);
        }
        window.agroviaToastTimer = setTimeout(function () {
            toast.fadeOut(400);
        }, 4500);
    };


    // ==========================================
    // GLOBAL SEARCH MODAL & INDEX
    // ==========================================
    var searchCatalog = [
        {
            title: "Precision Drip & Micro-Sprinkler Irrigation",
            category: "Agricultural Services",
            desc: "Smart soil-moisture-actuated irrigation loops saving up to 45% freshwater.",
            url: "service-detail.html"
        },
        {
            title: "Soil Fertility & Microbiome Testing",
            category: "Diagnostic & Agronomy",
            desc: "Comprehensive N-P-K assays, organic humus mapping, and tailored bio-amendments.",
            url: "service-detail.html"
        },
        {
            title: "Certified Organic Harvests & Crop Cultivation",
            category: "Farm Operations",
            desc: "Non-GMO heirloom seeds cultivated using zero synthetic fertilizers or pesticides.",
            url: "service.html"
        },
        {
            title: "Refrigerated Cold-Chain Farm Logistics",
            category: "Supply Chain",
            desc: "Temperature-monitored refrigerated fleet delivering fresh produce within 24 hours.",
            url: "service-detail.html"
        },
        {
            title: "Fresh Heirloom Vegetables & Greens",
            category: "Harvest Produce",
            desc: "Crisp organic butterhead lettuce, kale, heirloom carrots, and vine tomatoes.",
            url: "product.html"
        },
        {
            title: "Orchard Fresh Organic Fruits",
            category: "Harvest Produce",
            desc: "Tree-ripened Honeycrisp apples, Bartlett pears, Meyer lemons, and sweet strawberries.",
            url: "product.html"
        },
        {
            title: "Organic Whole Grains & Legumes",
            category: "Harvest Produce",
            desc: "Non-GMO hard red winter wheat, golden quinoa, and heritage lentils.",
            url: "product.html"
        },
        {
            title: "Pasture-Raised Dairy & Free-Range Poultry",
            category: "Harvest Produce",
            desc: "100% grass-fed organic butter, artisan cheese, and farm-fresh pasture eggs.",
            url: "product.html"
        },
        {
            title: "Weekly Farm CSA Subscription Boxes",
            category: "Pricing & Memberships",
            desc: "Seasonal family harvest baskets delivered fresh with 20% discount on annual subscriptions.",
            url: "pricing.html"
        },
        {
            title: "Wholesale Harvest Request & Farm Consultation",
            category: "Wholesale & Quotes",
            desc: "Custom quotes for restaurant groups, organic grocers, and institutional farm contracts.",
            url: "quote.html"
        },
        {
            title: "Modern Sustainable Farming Innovations",
            category: "Agronomy Blog",
            desc: "How regenerative cover crops restore depleted topsoil without chemical inputs.",
            url: "blog-detail.html"
        },
        {
            title: "Organic Certification Standards & Traceability",
            category: "FAQ & Knowledge Base",
            desc: "Detailed answers on USDA Organic compliance, non-GMO auditing, and batch QR codes.",
            url: "faq.html"
        },
        {
            title: "Agronomy Science & Leadership Team",
            category: "Company",
            desc: "Meet Agrovia's certified crop advisors, soil microbiologists, and master farmers.",
            url: "team.html"
        },
        {
            title: "Customer Testimonials & Farm Reviews",
            category: "Community",
            desc: "Read real reviews from restaurant chefs, food co-ops, and CSA family members.",
            url: "testimonial.html"
        },
        {
            title: "Contact Agrovia Farms & Headquarters",
            category: "Support",
            desc: "Visit our 2,400-acre farm campus in Sacramento Valley or submit an online inquiry.",
            url: "contact.html"
        },
        {
            title: "Farm Privacy Policy & Traceability Data",
            category: "Legal",
            desc: "Learn how we protect subscriber information and maintain transparent supply chain records.",
            url: "privacy.html"
        },
        {
            title: "Terms of Agricultural Supply & Freshness Guarantee",
            category: "Legal",
            desc: "Review our 100% farm freshness SLA, order cutoffs, and wholesale delivery policies.",
            url: "terms.html"
        }
    ];

    $('#agroviaSearchInput').on('input', function () {
        var query = $(this).val().toLowerCase().trim();
        var resultsContainer = $('#searchResultsContainer');
        if (!resultsContainer.length) return;

        if (query.length === 0) {
            resultsContainer.html(`
                <div class="text-center text-muted py-4">
                    <i class="fa fa-search fa-2x mb-2 text-secondary opacity-50"></i>
                    <p class="mb-0">Type keywords to search organic crops, farm services, pricing, or agronomy guides...</p>
                </div>
            `);
            return;
        }

        var matches = searchCatalog.filter(function (item) {
            return item.title.toLowerCase().indexOf(query) !== -1 ||
                   item.category.toLowerCase().indexOf(query) !== -1 ||
                   item.desc.toLowerCase().indexOf(query) !== -1;
        });

        if (matches.length === 0) {
            resultsContainer.html(`
                <div class="text-center py-4">
                    <i class="fa fa-leaf fa-2x mb-2 text-warning"></i>
                    <h6 class="text-dark">No matches found for "${query}"</h6>
                    <p class="text-muted small mb-0">Try searching for "organic", "irrigation", "soil", "pricing", or "csa".</p>
                </div>
            `);
            return;
        }

        var html = '<div class="list-group list-group-flush">';
        matches.forEach(function (item) {
            html += `
                <a href="${item.url}" class="search-result-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="search-result-title">${item.title}</span>
                        <span class="badge bg-success bg-opacity-25 text-success rounded-pill px-2 py-1 small">${item.category}</span>
                    </div>
                    <p class="search-result-desc">${item.desc}</p>
                </a>
            `;
        });
        html += '</div>';
        resultsContainer.html(html);
    });

    // Keyboard shortcut to open search modal (Ctrl+K or /)
    $(document).on('keydown', function (e) {
        if ((e.ctrlKey && e.key === 'k') || (e.key === '/' && !$(e.target).is('input, textarea'))) {
            var searchModal = $('#searchModal');
            if (searchModal.length) {
                e.preventDefault();
                var modal = bootstrap.Modal.getOrCreateInstance(searchModal[0]);
                modal.show();
                setTimeout(function () {
                    $('#agroviaSearchInput').focus();
                }, 400);
            }
        }
    });

    $('#searchModal').on('shown.bs.modal', function () {
        $('#agroviaSearchInput').focus();
    });


    // ==========================================
    // PRODUCT CATEGORY FILTER (product.html)
    // ==========================================
    $('.agro-filter-btn').on('click', function () {
        $('.agro-filter-btn').removeClass('active');
        $(this).addClass('active');

        var filter = $(this).attr('data-filter');
        var items = $('.product-item');

        if (filter === 'all' || !filter) {
            items.stop(true, true).fadeIn(400);
        } else {
            items.each(function () {
                var itemCat = $(this).attr('data-category');
                if (itemCat === filter) {
                    $(this).stop(true, true).fadeIn(400);
                } else {
                    $(this).stop(true, true).fadeOut(300);
                }
            });
        }
    });


    // ==========================================
    // PRICING FREQUENCY SWITCHER (pricing.html)
    // ==========================================
    $('#pricingBillingToggle').on('change', function () {
        var isAnnual = $(this).is(':checked');
        $('.pricing-card').each(function () {
            var monthly = $(this).data('price-monthly');
            var annual = $(this).data('price-annual');
            var priceDisplay = $(this).find('.price-amount');
            var cycleDisplay = $(this).find('.price-cycle');
            var savingsBadge = $(this).find('.savings-badge');

            if (isAnnual && annual) {
                priceDisplay.text('$' + annual);
                cycleDisplay.text('/ month (billed annually)');
                savingsBadge.fadeIn(200);
            } else if (monthly) {
                priceDisplay.text('$' + monthly);
                cycleDisplay.text('/ month');
                savingsBadge.fadeOut(200);
            }
        });

        if (isAnnual) {
            window.showAgroviaToast('Annual Savings Applied', 'You are viewing discounted yearly CSA subscription rates (Save 20%)!', 'fa fa-tag text-success', 'success');
        } else {
            window.showAgroviaToast('Monthly Billing', 'Switched to flexible month-to-month subscription rates.', 'fa fa-calendar-alt text-primary', 'info');
        }
    });


    // ==========================================
    // STAR RATING SELECTOR (reviewModal)
    // ==========================================
    $('.rating-stars i').on('mouseenter', function () {
        var starVal = parseInt($(this).data('rating'), 10);
        $(this).parent().find('i').each(function () {
            if (parseInt($(this).data('rating'), 10) <= starVal) {
                $(this).addClass('hover');
            } else {
                $(this).removeClass('hover');
            }
        });
    }).on('mouseleave', function () {
        $(this).parent().find('i').removeClass('hover');
    }).on('click', function () {
        var starVal = parseInt($(this).data('rating'), 10);
        $('#ratingValue').val(starVal);
        $(this).parent().find('i').each(function () {
            if (parseInt($(this).data('rating'), 10) <= starVal) {
                $(this).addClass('active text-warning');
            } else {
                $(this).removeClass('active text-warning');
            }
        });
    });


    // ==========================================
    // CONTACT FORM AJAX PROCESSOR
    // ==========================================
    $('#contactForm').on('submit', function (e) {
        e.preventDefault();
        var form = $(this);
        var submitBtn = form.find('button[type="submit"]');
        var originalBtnText = submitBtn.html();
        var alertBox = $('#contactAlert');

        var name = $.trim($('#contactName').val());
        var email = $.trim($('#contactEmail').val());
        var phone = $.trim($('#contactPhone').val());
        var subject = $.trim($('#contactSubject').val());
        var message = $.trim($('#contactMessage').val());

        if (!name || !email || !message) {
            alertBox.removeClass('d-none alert-success').addClass('alert alert-danger')
                .html('<i class="fa fa-exclamation-circle me-2"></i>Please fill in all required fields (Name, Email, Message).');
            return;
        }

        submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Transmitting...');

        var postData = {
            name: name,
            email: email,
            phone: phone,
            subject: subject,
            message: message
        };

        $.ajax({
            type: 'POST',
            url: 'mail/contact.php',
            data: postData,
            dataType: 'json',
            timeout: 5000
        }).done(function (response) {
            submitBtn.prop('disabled', false).html(originalBtnText);
            if (response && response.success) {
                alertBox.removeClass('d-none alert-danger').addClass('alert alert-success')
                    .html('<i class="fa fa-check-circle me-2"></i><strong>Thank you!</strong> ' + response.message);
                window.showAgroviaToast('Inquiry Received', response.message, 'fa fa-check-circle text-success', 'success');
                form[0].reset();
            } else {
                var errMsg = response && response.message ? response.message : 'Unable to submit your message. Please try again.';
                alertBox.removeClass('d-none alert-success').addClass('alert alert-danger')
                    .html('<i class="fa fa-exclamation-circle me-2"></i>' + errMsg);
            }
        }).fail(function () {
            // Client-side fallback for static execution without local PHP server
            submitBtn.prop('disabled', false).html(originalBtnText);
            var refCode = 'AGRO-INQ-' + Math.random().toString(36).substring(2, 8).toUpperCase();
            var successMsg = 'Thank you, ' + name + '! Your inquiry has been received (Ref: ' + refCode + '). An Agrovia agronomy specialist will reply to ' + email + ' within 24 hours.';

            alertBox.removeClass('d-none alert-danger').addClass('alert alert-success')
                .html('<i class="fa fa-check-circle me-2"></i>' + successMsg);
            window.showAgroviaToast('Message Sent (Ref: ' + refCode + ')', successMsg, 'fa fa-seedling text-success', 'success');
            form[0].reset();
        });
    });


    // ==========================================
    // QUOTE FORM PROCESSOR (Modal & Dedicated)
    // ==========================================
    function handleQuoteSubmission(formSelector, alertSelector, modalSelector) {
        $(formSelector).on('submit', function (e) {
            e.preventDefault();
            var form = $(this);
            var submitBtn = form.find('button[type="submit"]');
            var originalBtnText = submitBtn.html();
            var alertBox = $(alertSelector);

            var name = $.trim(form.find('input[name="name"]').val() || form.find('#quoteName').val());
            var email = $.trim(form.find('input[name="email"]').val() || form.find('#quoteEmail').val());
            var phone = $.trim(form.find('input[name="phone"]').val() || form.find('#quotePhone').val());
            var produceType = $.trim(form.find('select[name="produce_type"]').val() || form.find('#quoteProduceType').val());
            var quantity = $.trim(form.find('input[name="quantity"]').val() || form.find('#quoteQuantity').val());
            var deliveryDate = $.trim(form.find('input[name="delivery_date"]').val() || form.find('#quoteDate').val());
            var notes = $.trim(form.find('textarea[name="notes"]').val() || form.find('#quoteNotes').val());

            if (!name || !email) {
                if (alertBox.length) {
                    alertBox.removeClass('d-none alert-success').addClass('alert alert-danger')
                        .html('<i class="fa fa-exclamation-circle me-2"></i>Please enter your contact name and email.');
                }
                return;
            }

            submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Calculating Quote...');

            var quoteData = {
                name: name,
                email: email,
                phone: phone,
                produce_type: produceType,
                quantity: quantity,
                delivery_date: deliveryDate,
                notes: notes
            };

            $.ajax({
                type: 'POST',
                url: 'mail/quote.php',
                data: quoteData,
                dataType: 'json',
                timeout: 5000
            }).done(function (res) {
                submitBtn.prop('disabled', false).html(originalBtnText);
                if (res && res.success) {
                    if (alertBox.length) {
                        alertBox.removeClass('d-none alert-danger').addClass('alert alert-success')
                            .html('<i class="fa fa-check-circle me-2"></i><strong>Estimate Dispatched!</strong> ' + res.message);
                    }
                    window.showAgroviaToast('Quote Dispatched', res.message, 'fa fa-calculator text-success', 'success');
                    form[0].reset();
                    if (modalSelector) {
                        setTimeout(function () {
                            var modalEl = $(modalSelector);
                            if (modalEl.length) {
                                var modalInstance = bootstrap.Modal.getInstance(modalEl[0]);
                                if (modalInstance) modalInstance.hide();
                            }
                        }, 2500);
                    }
                }
            }).fail(function () {
                // Client-side fallback
                submitBtn.prop('disabled', false).html(originalBtnText);
                var quoteId = 'AGRO-ORD-' + Math.random().toString(36).substring(2, 8).toUpperCase();
                var msg = 'Quote request registered! Reference ID: ' + quoteId + '. Our farm logistics coordinator will deliver your itemized harvest estimate to ' + email + '.';

                if (alertBox.length) {
                    alertBox.removeClass('d-none alert-danger').addClass('alert alert-success')
                        .html('<i class="fa fa-check-circle me-2"></i>' + msg);
                }
                window.showAgroviaToast('Quote Registered (ID: ' + quoteId + ')', msg, 'fa fa-truck-moving text-success', 'success');
                form[0].reset();
                if (modalSelector) {
                    setTimeout(function () {
                        var modalEl = $(modalSelector);
                        if (modalEl.length) {
                            var modalInstance = bootstrap.Modal.getInstance(modalEl[0]);
                            if (modalInstance) modalInstance.hide();
                        }
                    }, 2200);
                }
            });
        });
    }

    handleQuoteSubmission('#quoteModalForm', '#quoteModalAlert', '#quoteModal');
    handleQuoteSubmission('#quotePageForm', '#quotePageAlert', null);
    handleQuoteSubmission('#quickQuoteForm', '#quickQuoteAlert', null);


    // ==========================================
    // NEWSLETTER SUBSCRIPTION HANDLER
    // ==========================================
    $('.newsletter-form').on('submit', function (e) {
        e.preventDefault();
        var emailInput = $(this).find('input[type="email"]');
        var email = $.trim(emailInput.val());

        if (!email || email.indexOf('@') === -1) {
            window.showAgroviaToast('Invalid Email', 'Please enter a valid email address to subscribe.', 'fa fa-exclamation-triangle text-danger', 'danger');
            return;
        }

        window.showAgroviaToast(
            'Subscribed to Agrovia Farm Dispatch!',
            'Thank you for subscribing. Weekly harvest updates and organic seasonal specials will be sent to ' + email + '.',
            'fa fa-paper-plane text-success',
            'success'
        );
        emailInput.val('');
    });


    // ==========================================
    // REVIEW SUBMISSION FORM (reviewModal)
    // ==========================================
    $('#reviewForm').on('submit', function (e) {
        e.preventDefault();
        var reviewerName = $.trim($('#reviewAuthor').val());
        var reviewerRole = $.trim($('#reviewRole').val()) || 'Organic Food Enthusiast';
        var reviewRating = $('#ratingValue').val() || '5';
        var reviewText = $.trim($('#reviewText').val());

        if (!reviewerName || !reviewText) {
            window.showAgroviaToast('Incomplete Review', 'Please include your name and review remarks.', 'fa fa-exclamation-circle text-danger', 'danger');
            return;
        }

        window.showAgroviaToast(
            'Review Submitted!',
            'Thank you, ' + reviewerName + '! Your ' + reviewRating + '-star review has been submitted for farm publication.',
            'fa fa-star text-warning',
            'success'
        );

        this.reset();
        $('.rating-stars i').removeClass('active hover');
        $('.rating-stars i[data-rating="5"]').addClass('active text-warning');
        $('#ratingValue').val('5');

        var reviewModal = $('#reviewModal');
        if (reviewModal.length) {
            setTimeout(function () {
                var modal = bootstrap.Modal.getInstance(reviewModal[0]);
                if (modal) modal.hide();
            }, 1200);
        }
    });


    // ==========================================
    // BLOG COMMENT SYSTEM (blog-detail.html)
    // ==========================================
    $('#blogCommentForm').on('submit', function (e) {
        e.preventDefault();
        var name = $.trim($('#commentName').val());
        var comment = $.trim($('#commentMessage').val());
        var commentsList = $('#blogCommentsList');

        if (!name || !comment) {
            window.showAgroviaToast('Missing Fields', 'Please enter your name and comment.', 'fa fa-exclamation-circle text-danger', 'danger');
            return;
        }

        var newComment = `
            <div class="d-flex mb-4 p-3 bg-light rounded wow fadeIn">
                <div class="flex-shrink-0">
                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold" style="width: 50px; height: 50px; font-size: 1.2rem;">
                        ${name.charAt(0).toUpperCase()}
                    </div>
                </div>
                <div class="ms-3 flex-grow-1">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <h6 class="mb-0 text-dark fw-bold">${name}</h6>
                        <small class="text-muted">Just now</small>
                    </div>
                    <p class="text-secondary mb-0">${comment}</p>
                </div>
            </div>
        `;

        if (commentsList.length) {
            commentsList.prepend(newComment);
        }

        window.showAgroviaToast(
            'Comment Published',
            'Your commentary has been added to this agronomy insight thread.',
            'fa fa-comment-dots text-success',
            'success'
        );

        this.reset();
    });

})(jQuery);