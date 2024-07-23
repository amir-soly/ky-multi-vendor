jQuery(document).ready(function ($) {
    // event listener for the search submit button
    $('#mv_search_prodcu_form').submit(function (e) {
        e.preventDefault();

        let searchValue = $('#mv_product_search').val().trim();

        if (searchValue === '') {
            alert('لطفاً نام یک محصول را وارد کنید.');
            return;
        }

        let originalText = $('#mv_search_submit').text();
        $('#mv_search_submit').html('<svg class="animate-spin mx-auto" xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M21 12a9 9 0 11-6.219-8.56"></path> </g></svg>');


        // perform AJAX request
        $.ajax({
            url: stm_wpcfto_ajaxurl,
            type: 'POST',
            data: {
                action: 'search_products',
                search_query: searchValue,
                action_type: 'add_product',
            },
            success: function (response) {
                $('#product_results_container').show();
                $('#results_count').html(`${response.data.products.length} مورد`);

                $('#mv_search_submit').html(originalText);
                if (response.success) {
                    displayProducts(response.data.products);
                } else {
                    $('#product_results').html('<p class="text-center text-xl">محصولی یافت نشد!</p>');
                }
            },
            error: function (xhr, status, error) {
                $('#product_results_container').show();
                $('#mv_search_submit').html(originalText);

                $('#product_results').html('<p class="text-center text-xl">مشکلی پیش آمده دوباره امتحان کنید.</p>');
            },
        });
    });

    // function to display products in the results section
    function displayProducts(products) {
        let html = '';
        products.forEach(function (product) {
            let addProductBtn;

            if (product.exists == 'true') {
                addProductBtn = `<button class="py-2.5 px-10 text-sm rounded-3xl font-bold bg-primary text-secondary transition-all">فروشنده هستید</button>`;
            } else {
                addProductBtn = `<button class="mv_add_product_too py-2.5 px-10 text-sm rounded-3xl font-bold border border-gray transition-all hover:bg-primary hover:text-secondary hover:border-primary" product-id="${product.product_id}" user-id="${product.seller_id}">شما هم بفروشید</button>`;
            }
            html += `
                <div class="mb-6 pb-6 border-b border-lite-gray last:border-none">
                    <div class="flex-cb mb-6">
                        <div class="btn-flex">
                            <img src="${product.thumbnail}" alt="${product.title}" width="90">
                            <p class="text-xs text-paragraph">${product.title}</p>
                        </div>
                        ${addProductBtn}
                    </div>
                    <div class="flex items-center gap-16">
                        <div>
                            <span class="text-xs text-paragraph">گروه:</span>
                            <span class="text-sm text-secondary">${product.terms}</span>
                        </div>
                        <div>
                            <span class="text-xs text-paragraph">وضعیت جاری:</span>
                            <span class="text-sm text-secondary">${product.exists == 'true' ? 'موجود' : 'غیر موجود'}</span>
                        </div>
                        <div>
                            <span class="text-xs text-paragraph">قیمت:</span>
                            <span class="text-sm text-secondary">${product.price}</span>
                        </div>
                    </div>
                </div>
            `;
        });
        $('#product_results').html(html);
    }


    // add product
    $(document).on("click", ".mv_add_product_too", function (e) {
        e.preventDefault();

        let productId = $(this).attr("product-id");
        let userId = $(this).attr("user-id");
        let ajaxUrl = $(this).attr("ajax-url");
        let nonce = $(this).attr("wp-nonce");

        $("#mv_submit_product").data("product-id", productId);
        $("#mv_submit_product").data("user-id", userId);
        $("#mv_submit_product").data("ajax-url", ajaxUrl);
        $("#mv_submit_product").data("wp-nonce", nonce);
    });

    $("#close-modal-add-product").on("click", function () {

    });

    // show and hide sales date fields
    $("#toggle-sale-schedule").on("click", function () {
        $(".sale-date-fields").toggleClass("hidden");
        let isHidden = $(".sale-date-fields").hasClass("hidden");
        $(this).text(isHidden ? "زمان بندی فروش" : "لغو زمان بندی");
    });

    // send AJAX request
    $("#add_product_form").on("click", function (e) {
        e.preventDefault();

        let productId = $(this).data("product-id");
        let userId = $(this).data("user-id");
        let nonce = $(this).data("wp-nonce");

        let regularPrice = $("#mv_regular_price").val();
        let salePrice = $("#mv_sale_price").val();
        let fromSaleDate = $("#mv_from_sale_date").val();
        let toSaleDate = $("#mv_to_sale_date").val();
        let stock = $("#mv_stock").val();
        let minStock = $("#mv_min_stock").val();
        let soldIndividually = $("#mv_sold_individually").is(":checked") ? "yes" : "no";

        $.ajax({
            type: "POST",
            url: stm_wpcfto_ajaxurl,
            data: {
                action: "mv_add_product",
                nonce: nonce,
                product_id: productId,
                user_id: userId,
                regular_price: regularPrice,
                sale_price: salePrice,
                from_sale_date: fromSaleDate,
                to_sale_date: toSaleDate,
                stock: stock,
                min_stock: minStock,
                sold_individually: soldIndividually,
            },
            success: function (response) {
                let data = response.data;
                if (data.is_sent) {
                    $("#popup_overlay").hide();
                    $("#add_product_popup").hide();
                    clearForm();
                } else {
                    let message = data.message;
                    $(".alert-box").empty().slideDown(50).append('<p class="ErrorMessage">' + message + "</p>");
                }
            },
            error: function (response) {
                console.log("Error:", response);
            },
        });
    });

    // clear the form
    function clearForm() {
        $("#mv_regular_price").val("");
        $("#mv_sale_price").val("");
        $("#mv_from_sale_date").val("");
        $("#mv_to_sale_date").val("");
        $("#mv_stock").val("");
        $("#mv_min_stock").val("");
        $("#mv_sold_individually").prop("checked", false);
        $("#sale-date-fields").addClass("hidden");
        $("#toggle-sale-schedule").text("زمان بندی فروش");
    }
});



// document.getElementById('get_orders_export').addEventListener('click', function() {
//     var sellerId = '114'; // شناسه فروشنده را به درستی مقداردهی کنید

//     var formData = new FormData();
//     formData.append('action', 'export_orders');
//     formData.append('seller_id', sellerId);

//     fetch('PATH_TO_YOUR_PHP_SCRIPT', { // مسیر به فایل PHP که در بالا کدش آورده شده
//         method: 'POST',
//         body: formData
//     })
//     .then(response => response.blob())
//     .then(blob => {
//         var url = window.URL.createObjectURL(blob);
//         var a = document.createElement('a');
//         a.style.display = 'none';
//         a.href = url;
//         a.download = 'orders.xlsx';
//         document.body.appendChild(a);
//         a.click();
//         window.URL.revokeObjectURL(url);
//     })
//     .catch(error => console.error('Error:', error));
// });
